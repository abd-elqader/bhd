<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Central\PackageUser;
use App\Models\Central\Package;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Client;
use App\Models\Tenant;

class PackageController extends Controller
{
    public function index()
    {
        $Subscriptions = PackageUser::latest()->with('Package')->where('client_id',tenant()->client_id)->get();
        $Packages = Package::latest()->get();
        return view('Tenant.Admin.packages.index',compact('Packages','Subscriptions'));
    }

    public function store(Request $request)
    {
        $Client = \DB::connection('mysql')->table('clients')->where('id', tenant()->client_id)->first();
        if(request()->package_id){
            $Package = Package::where('id',request()->package_id)->first();
        }else{
            $Package = PackageUser::latest()->with('Package')->where('client_id',tenant()->client_id)->first()->Package;
        }
        $IndividualDomain = $Client->domain ? setting('IndividualDomain') : 0;
        $price = (float) $Package->price() + (float) $IndividualDomain;
        if ($price > 0) {
            PackageUser::create([
                'package_id' => $Package->id,
                'client_id' => $Client->id,
                'start_date' => now(),
                'end_date' => now()->addDays($Package->days),
                'paid' => 0,
            ]);
            $redirect = VerifyTapTransaction(env('TAP_SECRET_KEY'), 1, $Client->id, $price, 0, $price, $Client->name, null, null, $Client->phone, $Client->email);
            return redirect()->away($redirect);
        }else{
            PackageUser::create([
                'package_id' => $Package->id,
                'client_id' => $Client->id,
                'start_date' => now(),
                'end_date' => now()->addDays($Package->days),
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
