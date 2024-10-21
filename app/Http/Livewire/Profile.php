<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use App\Models\Central\Package;
use App\Models\Central\PackageUser;
use Livewire\Component;

class Profile extends Component
{
    public $currentStep = 1;

    public $totalSteps = 5;

    public $domain_name = null;

    public $domain = null;
    
    public $user_domain = null;

    public $tenant_exists = false;

    public $approved = false;

    public $user;

    public $tenant;
    
    public $UserPackage;
    
    public $IndividualDomain = 0;
    
    public $SelectedPackage = 0;
    
    public function mount()
    {
        $this->user = auth('client')->user();
        $this->approved = $this->user->status ? true : false;
        $this->user_domain = $this->user->domain_name;
        $this->UserPackage = PackageUser::where('paid',1)->where('client_id',$this->user->id)->orderBy('id','desc')->first();
    }

    public function render()
    {
        return view('Central.User.profile')->extends('Central.User.components.profileLayout')->section('content');
    }

    public function SelectPackageId()
    {
            
        $value = $this->SelectedPackage;
        if($this->IndividualDomain && $value == 1 && !preg_match('/^(?!\-)(?:(?:[a-zA-Z\d][a-zA-Z\d\-]{0,61})?[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/', $this->domain)  ){
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('website.InvalidDomain')]);
        }else{
            $this->user->domain = $this->domain;
            $this->user->save();
                
            $Package = Package::findorfail($value);
            $price = (float) $Package->price_after + ($this->IndividualDomain ? setting('IndividualDomain') : 0);
            PackageUser::where('client_id',$this->user->id)->delete();
            $PackageUser = PackageUser::create([ 
                'package_id' => $Package->id,
                'client_id' => $this->user->id,
                'paid' => 0,
                'start_date' => now(),
                'end_date' => now()->addDays($Package->days),
            ]);
            
            if ($price > 0) {
                $redirect = VerifyTapTransaction(env('TAP_SECRET_KEY'), 1, auth('client')->id(), $price, 0, $price, $this->user->name, null, null, $this->user->phone, $this->user->email);
                return redirect()->away($redirect);
            }else{
                $PackageUser->paid = 1;
                $PackageUser->save();
                
                $this->user->status = 1;
                $this->user->save();
                
                session()->put('data', $this->user);
                CreateDB($this->user->domain_name);
                AssignAllPrivileges($this->user->domain_name);
                CreateEmail($this->user->domain_name);
                CreateSubDomain($this->user->domain_name);
                
                $tenant = Tenant::firstOrCreate(['id' => $this->user->domain_name],['id' => $this->user->domain_name, 'client_id' => $this->user->id]);
                $tenant->paid = 1;
                $tenant->save();
                if($tenant->domains()->count() == 0)
                    $tenant->domains()->create(['domain' => $this->user->domain_name.'.'.env('APP_DOMAIN')]);
                
                
                \DB::table('tenants')->where('id', $this->user->domain_name)->update([
                    'paid'=>1,
                    'status'=>1,
                    'client_id'=>$this->user->id,
                ]);
                
                
            	\Artisan::call('tenants:migrate-fresh', [
                    '--tenants' => [$this->user->domain_name],
                ]);
                \Artisan::call('tenants:seed', [
                    '--tenants' => [$this->user->domain_name],
                    '--force' => true
                ]);
            }
            $this->PackageUser = PackageUser::where('client_id',$this->user->id)->orderBy('id','desc')->first();
            $this->GoToDashboard();   
        }
    }

    public function SelectPackage($value)
    {
        $this->user->domain = NULL;
        $this->user->save();
        $this->SelectedPackage = $value;
    }

    public function increaseStep()
    {
        $this->currentStep++;
        if (! blank($this->domain_name) && $this->tenant_exists == false && strlen($this->domain_name) > 3) {
            $this->user->domain_name = $this->domain_name;
            $this->user->save();
        }
        $this->mount();
    }

    public function decreaseStep()
    {
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
        $this->mount();
    }
    
    public function VerifySubDomain()
    {
        $this->domain_name = strtolower(str_replace('-', '',preg_replace('/[0-9]+/', '', preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(' ', '', $this->domain_name)))));
        if (strlen($this->domain_name) <= 3) {
            $this->tenant_exists = true;
        } else {
            $this->tenant_exists = Tenant::where('id', $this->domain_name)->count() > 0;
        }
        $this->mount();
    }
    public function GoToDashboard()
    {
        $url = tenant_route(Tenant::where('id', auth('client')->user()->domain_name)->first()->id.'.'.env('APP_DOMAIN'), 'admin.login_wihout_form',[
            'phone'=> $this->user->phone,
            'password'=> $this->user->password,
        ]);
        
        return redirect()->route('timeout',['url' => $url]);
    }

}
