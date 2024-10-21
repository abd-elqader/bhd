<?php

namespace App\Http\Controllers\Central\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\User\LoginRequest;
use App\Http\Requests\Central\User\ForgetRequest;
use App\Http\Requests\Central\User\RegisterRequest;
use App\Models\Client;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth('client')->attempt($request->only('phone', 'password'))) {
            return redirect()->route('client.profile');
        }
        alert()->error(__('messages.emailPasswordIncorrect'));
        return redirect()->back();
    }

    public function register(RegisterRequest $request)
    {
        $client = Client::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'benefit' => $request->get('benefit'),
            'iban' => $request->get('iban'),
            'phone' => $request->get('phone'),
            'phone_code' => $request->get('phone_code')  ?? 'BH',
            'country_code' => $request->get('country_code') ?? '+973',
            'password' => bcrypt($request->get('password')) ,
        ]);
        auth('client')->login($client);
        return redirect()->route('client.profile');
    }

    public function forget(ForgetRequest $request)
    {
        $client = Client::where('phone',$request->phone)->update([
            'password' => bcrypt($request->get('password')),
        ]);
        alert()->success(__('messages.updatedSuccessfully'));
        return redirect()->route('client.login');
    }

    public function logout()
    {
        if (auth('client')->check()) {
            auth('client')->logout();
        }

        alert()->success(__('messages.logoutSuccessfully'));

        return redirect()->back();
    }
}
