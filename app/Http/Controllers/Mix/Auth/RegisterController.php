<?php

namespace App\Http\Controllers\Mix\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\User\RegisterRequest;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        if (! tenant()) {
            return view('Mix.auth.register');
        } else {
            return redirect()->route('admin.login');
        }
    }

    public function register(RegisterRequest $request)
    {
        abort(404);
        Session::put('data', $request->validated());
        $domain = strtolower(str_replace(' ', '', $request->domain_name));
        $tenant = Tenant::create(['id' => $domain]);
        $tenant->update(['data->tenancy_db_name' => 'matjrbh_'.$domain]);
        $domain = $domain . '.' . env('APP_DOMAIN');
        $tenant->domains()->create(['domain' => $domain]);
        return redirect()->route('admin.login')->domain($domain);
    }
}
