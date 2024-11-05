<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Central\ServiceUser;
use App\Models\Central\Service;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Client;
use App\Models\Tenant;

class ServiceController extends Controller
{
    public function index()
    {
        $Subscriptions = ServiceUser::latest()->with('Service')->where('client_id',tenant()->client_id)->get();
        // dd($Subscriptions);
        $Services = Service::latest()->with('users')->paginate();
        return view('Tenant.Admin.services.index',compact('Services','Subscriptions'));
    }

    public function store(Request $request)
    {
        $Client = \DB::connection('mysql')->table('clients')->where('id', tenant()->client_id)->first();
        if(request()->service_id){
            $Service = Service::where('id',request()->service_id)->first();
        }else{
            $Service = ServiceUser::latest()->with('Service')->where('client_id',tenant()->client_id)->first()->Package;
        }
        $IndividualDomain = $Client->domain ? setting('IndividualDomain') : 0;
        $price = (float) $Service->price() + (float) $IndividualDomain;
        if ($price > 0) {
            ServiceUser::updateOrCreate([
                'service_id' => $Service->id,
                'client_id' => $Client->id
                ],[
                'start_date' => now(),
                'end_date' => now()->addDays($Service->days),
                'paid' => 0,
            ]);
            $redirect = VerifyTapTransaction(env('TAP_SECRET_KEY'), 1, $Client->id, $price, 0, $price, $Client->name, null, null, $Client->phone, $Client->email);
            return redirect()->away($redirect);
        }else{
            ServiceUser::create([
                'service_id' => $Service->id,
                'client_id' => $Client->id,
                'start_date' => now(),
                'end_date' => now()->addDays($Service->days),
                'paid' => 1,
            ]);
            // \DB::table('tenants')->where('id',  $Client->domain_name)->update([
            //     'paid'=>1,
            //     'status'=>1,
            //     'client_id'=>$Client->id,
            // ]);
            return redirect()->back();
        }
    }
}
