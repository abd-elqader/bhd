<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreClientRequest;
use App\Http\Requests\Mix\Admin\UpdateClientRequest;
use App\Models\Client;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clients-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:clients-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:clients-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:clients-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Clients = Client::query();
            if ($request->requests) {
                $Clients = $Clients->where('status', 0)->whereNotNull('domain_name')->has('Transactions')->has('Packages');
            }

            return Datatables::of($Clients)
                ->addColumn('action', function ($Client) {
                    return '<a style="color: #000;" href="'.route('admin.clients.show', $Client).'"><i class="fas fa-eye"></i></a>
                        <a style="color: #000;" href="'.route('admin.clients.edit', $Client).'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="formDelete" method="POST" action="'.route('admin.clients.destroy', $Client).'">
                            '.csrf_field().'
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                        </form>';
                })
                ->addColumn('approve', function ($Client) {
                    if ($Client->status) {
                        return  __('messages.Approved');
                    } else {
                        $db_name = 'matjrbh_'.$Client->domain_name;
                        $SubDomain = $Client->domain_name;

                        return '<label data-id="'.$Client->id.'" onclick="acceptTenant('.$Client->id.',\''.$db_name.'\',\''.$SubDomain.'\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Client->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('domain_name', function ($Client) {
                    if ($Client->status == 0) {
                        return  $Client->domain_name;
                    } else {
                        return '<a target="_blanck" style="color: blue;" href="'.tenant_route(Tenant::where('id', $Client->domain_name)->first()->id.'.'.env('APP_DOMAIN'), 'client.home').'">'.$Client->domain_name.'</a>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status', 'addresses')
                ->make(true);
        }

        return view('Central.Admin.clients.index');
    }

    public function create()
    {
        return view('Central.Admin.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $Client = Client::create($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        $Client->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $Client->image = Upload::UploadFile($request->image, 'Clients');
        }
        $Client->save();
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Client $Client)
    {
        $Client = $Client->firstorfail();

        return view('Central.Admin.clients.show', compact('Client'));
    }

    public function edit(Client $Client)
    {
        return view('Central.Admin.clients.edit', compact('Client'));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        $Client = Client::where('id', $id)->firstorfail();
        $Client->update($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        if ($request->hasFile('image')) {
            $Client->image = Upload::UploadFile($request->image, 'Clients');
        }
        if ($request->password) {
            $Client->password = bcrypt($request->password);
        }
        $Client->save();
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($client_id)
    {
        $Client = Client::where('id', $client_id)->find($client_id);
        if ($Client) {
            $Tenant = Tenant::where('data->client_id', $Client->id)->orwhere('id', $Client->domain_name)->first();
            if ($Tenant) {
                $Tenant->database()->manager()->deleteDatabase($Tenant);
                $Tenant->forceDelete();
            }
            $Client->forceDelete();
        }
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function acceptTenant(Request $request)
    {
        $Client = Client::where('id', $request->user_id)->first();
        $subDomain = $Client->domain_name;
        Session::put('data', $Client);
        $Tenant = Tenant::create(['id' => $subDomain, 'client_id' => $Client->id]);
        $Tenant->domains()->create(['domain' => $subDomain.'.'.env('APP_DOMAIN')]);
        $Client->status = 1;
        $Client->save();

        return response()->json(__('messages.Approved'));
    }
}
