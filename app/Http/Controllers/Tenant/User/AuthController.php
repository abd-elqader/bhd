<?php

namespace App\Http\Controllers\Tenant\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\User\LoginRequest;
use App\Http\Requests\Tenant\User\ProfileRequest;
use App\Http\Requests\Tenant\User\RegisterRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth('client')->attempt($request->only('phone', 'password'))) {
            alert()->success(__('messages.loginSuccessfully'));
            return redirect()->route('client.home');
        }
        alert()->error(__('messages.emailPasswordIncorrect'));
        return redirect()->back()->with(request()->all());
    }

    public function register(RegisterRequest $request)
    {
        $client = Client::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'phone_code' => '+'.$request->get('phone_code'),
            'country_code' => $request->get('country_code'),
            'password' => bcrypt($request->get('password')),
        ]);
        auth('client')->login($client);

        alert()->success(__('messages.profileCompleted'));

        return redirect()->route('client.home');
    }

    public function profile(ProfileRequest $request)
    {
        $user = auth('client')->user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->has('password') && ! empty($request->get('password'))) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        alert()->success(__('messages.profileUpdated'));

        return redirect()->back();
    }

    public function forget(Request $request)
    {
        Client::where('phone', 'LIKE', '%'.$request->phone.'%')->update([
            'password' => bcrypt($request->get('password')),
        ]);
        alert()->success(__('messages.profileUpdated'));

        return redirect()->back();
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
