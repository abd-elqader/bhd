<?php

namespace App\Http\Controllers\Mix\Auth;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Models\Client as User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);

                return redirect()->route('messages');
            } else {
                $imagePath = Upload::StoreUrlImage($user->image, 'users-image') ?? 'logo.png';
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $imagePath,
                    'image' => $imagePath,
                    'google_id' => $user->id,
                    'password' => encrypt('password'),
                ]);
                DB::table('ch_messages')->insert([
                    'id' => mt_rand(9, 999999999) + time(),
                    'type' => 'user',
                    'to_id' => $newUser->id,
                    'from_id' => 1,
                    'body' => 'Hi',
                ]);

                Auth::login($newUser);

                return redirect()->route('messages');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
