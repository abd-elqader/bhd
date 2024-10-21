<?php

namespace App\Http\Controllers\Mix\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('Mix.auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }
}
