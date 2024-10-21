<?php

namespace App\Http\Controllers\Central\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\StoreTenantRequest;
use App\Http\Requests\Central\Admin\UpdateTenantRequest;
use App\Models\Client;
use App\Models\Visit;
use App\Models\Tenant;
use App\Models\Central\PackageUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Carbon\Carbon;

class TenantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sites-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:sites-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sites-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sites-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Tenants = Tenant::with('domains','Client')->latest();

            return DataTables::of($Tenants)
                ->addColumn('action', function ($Tenant) use ($request) {
                    $Full_Domain = str_replace($request->gethost(), $Tenant?->domains->first()?->domain, env('APP_URL'));

                    return '<a style="color: #000;" href="'.route('admin.website.statistics', $Tenant).'"><i class="fa-solid fa-chart-line"></i></a>
                            <a style="color: #000;" href="'.route('admin.websites.show', $Tenant).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.websites.edit', $Tenant).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.websites.destroy', $Tenant).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->editColumn('id', function ($Tenant) use ($request) {
                    $Full_Domain = str_replace($request->gethost(), $Tenant?->domains->first()?->domain, env('APP_URL'));

                    return '<a target="_blanck" style="color: blue;" href="'.$Full_Domain.'">'.$Tenant->id.'</a>';
                })
                ->editColumn('status', function ($Tenant) {
                    $id = "'".$Tenant->id."'";
                    if ($Tenant->status) {
                        return '<label data-id="'.$id.'" onclick="toggleswitch('.$id.',\'tenants\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Tenant->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$id.'" onclick="toggleswitch('.$id.',\'tenants\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Tenant->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addColumn('valid', function ($Tenant) use ($request) {
                    if($Tenant?->Client->id > 1)
                    return $Tenant?->Client?->Packages()->wherePivot('start_date','<=',now())->wherePivot('end_date','>=',now())->wherePivot('paid',1)->count() ? __('dashboard.valid') : __('dashboard.expired');
                })
                ->addColumn('username', function ($Tenant) use ($request) {
                    return $Tenant?->Client?->name;
                })
                ->addColumn('benefit_iban', function ($Tenant) use ($request) {
                    return $Tenant?->Client?->iban . '<br>' . $Tenant?->Client?->benefit;
                })
                ->addColumn('phone_email', function ($Tenant) use ($request) {
                    return $Tenant?->Client?->phone . '<br>' . $Tenant?->Client?->email;
                })
                
                ->addColumn('end_date', function ($Tenant) use ($request) {
                    $end_date =  ($Tenant && $Tenant?->Client) ?  PackageUser::latest()->where('client_id',$Tenant?->Client->id)->first()?->end_date : '';
                    return '<a target="_blanck" style="color: blue;" href="'.route('admin.websites.edit', $Tenant).'">'.$end_date.'</a>';
                })
                
                ->addColumn('domain', function ($Tenant) use ($request) {
                    $Full_Domain = str_replace($request->gethost(), $Tenant?->domains->first()?->domain, env('APP_URL'));

                    return '<a target="_blanck" style="color: blue;" href="'.$Full_Domain.'">'.$Full_Domain.'</a>';
                })
                ->addColumn('db', function ($Tenant) {
                    return  'matjrbh_'.$Tenant?->domains->first()?->tenant_id;
                })
                ->escapeColumns('action')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                 ->filter(function ($instance) use ($request) {
                    if ($request->name && !is_null($request->name)) {
                        $instance->where('id', 'LIKE', '%' . $request->name . '%')->orwhere('id', Client::where('name','LIKE', '%' . $request->name . '%')->value('domain_name'));
                    }
           
                    if ($request->email && !is_null($request->email)) {
                        $instance->where('id', Client::where('email','LIKE', '%' . $request->email . '%')->value('domain_name'));
                    }
                    if ($request->phone && !is_null($request->phone)) {
                        $instance->where('id', Client::where('phone','LIKE', '%' . $request->phone . '%')->value('domain_name'));
                    }
                    
                    if (!is_null($request->valid)) {
                        $instance->where('paid',$request->valid == 'Valid' ? 1 : 0);
                    }
                })
                ->toJson();
        }

        return view('Central.Admin.websites.index');
    }

    public function create()
    {
        $clients = Client::doesnthave('tenant')->get();

        return view('Central.Admin.websites.create', compact('clients'));
    }

    public function store(StoreTenantRequest $request)
    {
        $subDomain = strtolower(str_replace(' ', '', $request->subdomain));
        $tenant = Tenant::create(['id' => $subDomain, 'client_id' => $request->client_id]);
        $domain = $subDomain.'.'.env('APP_DOMAIN');
        $tenant?->domains()->create(['domain' => $domain]);
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function statistics(Tenant $Tenant)
    {
        \Config::set("database.connections.mysql", [
            "driver" => 'mysql',
            "host" => env('DB_HOST'),
            "database" => 'matjrbh_' . $Tenant->id,
            "username" => env('DB_USERNAME'),
            "password" => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
        DB::purge('mysql');
        DB::reconnect('mysql');

        $chartOrders = \App\Models\Tenant\Order::select([DB::raw('DATE(created_at) AS label'), DB::raw("(COUNT(*)) as y")])->groupBy('label')->get()->toarray();
        $chartUsers = \App\Models\Client::whereNotNull('created_at')->select([DB::raw('DATE(created_at) AS label'), DB::raw("(COUNT(*)) as y")])->groupBy('label')->get()->toarray();
        $chartChanges = \App\Models\Tenant\Order::select( DB::raw('sum(net_total) as y'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as label" ))->groupBy('label')->orderBy('created_at')->get()->toarray();

        $categoriesCount = \App\Models\Tenant\Category::all()->count();
        $productsCount = \App\Models\Tenant\Product::all()->count();
        $clientsCount = Client::all()->count();
        $currentOrdersCount = \App\Models\Tenant\Order::where('status', 1)->whereIn('follow', [0, 1, 2])->get()->count();
        $previousOrdersCount = \App\Models\Tenant\Order::where('status', 1)->whereIn('follow', [3])->get()->count();
        $sliderCount = \App\Models\Image::where('type_id',1)->count();
           
        $DayVisits = Visit::select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%d-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->groupby('new_date')->where(DB::raw('YEAR(created_at)'), '=', date('Y'))->get();
        $MonthVisits = Visit::where(DB::raw('YEAR(created_at)'), '=', date('Y'))->select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('month')->get();
        $YearVisits = Visit::select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year')->get();
 
        $Google = Visit::distinct('ip')->where('referer', 'like', '%google%')->count();
        $Instagram = Visit::distinct('ip')->where('referer', 'like', '%instagram%')->count();
        $Twitter = Visit::distinct('ip')->where('referer', 'like', '%twitter%')->count();
        $Snapchat = Visit::distinct('ip')->where('referer', 'like', '%snapchat%')->count();
        $Facebook = Visit::distinct('ip')->where('referer', 'like', '%facebook%')->count();
        $Behance = Visit::distinct('ip')->where('referer', 'like', '%behance%')->count();
        $Tiktok = Visit::distinct('ip')->where('referer', 'like', '%tiktok%')->count();
        $LinkedIn = Visit::distinct('ip')->where('referer', 'like', '%linkedIn%')->count();
        
        return view('Central.Admin.websites.statistics',compact(
            'Tenant',
            'categoriesCount',
            'productsCount',
            'clientsCount',
            'currentOrdersCount',
            'previousOrdersCount',
            'sliderCount',
            'chartOrders',
            'chartUsers',
            'chartChanges',
            'Google', 'Facebook', 'Instagram', 'Twitter', 'Snapchat', 'Behance', 'Tiktok', 'LinkedIn'
        ));
    }

    public function show($id)
    {
        $Tenant = Tenant::with('Client')->find($id);
        return view('Central.Admin.websites.show', compact('Tenant'));
    }

    public function edit($id)
    {
        $Tenant = Tenant::where('id',$id)->first();
        $end_date = date('Y-m-d', strtotime(PackageUser::latest()->where('client_id',$Tenant?->Client->id)->first()?->end_date));
        return view('Central.Admin.websites.edit', compact('Tenant','end_date'));
    }

    public function update(Request $request, $id)
    {
        $Tenant = Tenant::where('id',$id)->first();

        if(PackageUser::where('client_id',$Tenant->Client->id)->where('paid',1)->latest()->count()){
            PackageUser::where('client_id',$Tenant->Client->id)->where('paid',1)->latest()->first()->update($request->only('end_date'));
        }else{
            if($request->end_date && Carbon::parse( $request->end_date )->isFuture() ){
                PackageUser::where('client_id',$Tenant->client_id ?? $Tenant->Client->id)->latest()->first()->update(['paid' => 1]+$request->only('end_date'));
            }
        }
        CLient::where('id',$Tenant->Client->id)->update($request->only('name','email','phone'));
        if($request->password){
            CLient::where('id',$Tenant->Client->id)->update([
                'password' => bcrypt($request->password)    
            ]);
        }
        alert()->success(__('messages.updatedSuccessfully'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        Client::where('domain_name', $id)->forceDelete();
        Tenant::where('id' , $id)->forceDelete();
        DeleteDB($id);
        DeleteSubDomain($id);
        alert()->success(__('messages.DeletedSuccessfully'));
        return redirect()->back();
    }
}
