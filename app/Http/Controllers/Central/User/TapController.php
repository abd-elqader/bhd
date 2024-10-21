<?php

namespace App\Http\Controllers\Central\User;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Tenant;
use App\Models\Central\Package;
use App\Models\Central\PackageUser;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TapController extends Controller
{
    public function payment_response(Request $request)
    {
        $charge_data = ResponseTapTransaction(env('TAP_SECRET_KEY'), request()->tap_id);
        if($charge_data){
            $Client = Client::where('phone', $charge_data['customer']['phone']['number'])->first();
            auth('client')->login($Client);
            $Package = $Client->Packages()->orderBy('id','desc')->first();
            
            if(isset($charge_data['id'])){
                Transaction::create([
                    'client_id' => $Client->id,
                    'package_id' => $Package->id,
                    'transaction_number' => $charge_data['id'],
                    'value' => $charge_data['amount'],
                    'result' => $charge_data['status'],
                    'type' => 'TAP',
                ]);
            }
            if( ($charge_data['status'] == 'PAID' || $charge_data['status'] == 'CAPTURED')  ){


                PackageUser::where('client_id',$Client->id)->orderBy('id','desc')->update([
                    'start_date' => now(),
                    'end_date' => now()->addDays($Package->days),
                    'paid' => 1,
                ]);
                
                $Client->status = 1;
                $Client->save();
                $tenant = Tenant::where('id' , $Client->domain_name)->first();
                if(!$tenant){
                    session()->put('data', $Client);
                    CreateDB($Client->domain_name);
                    AssignAllPrivileges($Client->domain_name);
                    CreateSubDomain($Client->domain_name);
                }
                
                $tenant = Tenant::firstOrCreate(['id' => $Client->domain_name],['id' => $Client->domain_name, 'client_id' => $Client->id]);
                
                \DB::table('tenants')->where('id', $Client->domain_name)->update([
                    'paid'=>1,
                    'status'=>1,
                    'client_id'=>$Client->id,
                ]);
                if($tenant->domains()->count() == 0){
                    $tenant->domains()->create(['domain' => $Client->domain_name.'.'.env('APP_DOMAIN')]);
                    \Artisan::call('tenants:migrate-fresh', [
                        '--tenants' => [$Client->domain_name],
                    ]);
                    \Artisan::call('tenants:seed', [
                        '--tenants' => [$Client->domain_name],
                        '--force' => true
                    ]);
                }
            }
            return redirect()->route('client.profile');
        }else{
            abort(404);
        }
    }
}
