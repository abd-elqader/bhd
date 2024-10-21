<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Helper\WhatsApp;
use App\Http\Requests\Tenant\API\CheckNumberRequest;
use App\Http\Requests\Tenant\API\DeviceTokenRequest;
use App\Http\Requests\Tenant\API\LoginRequest;
use App\Http\Requests\Tenant\API\OTPRequest;
use App\Http\Requests\Tenant\API\RegisterRequest;
use App\Http\Requests\Tenant\API\UpdateProfileRequest;
use App\Http\Resources\Tenant\ClientResource;
use App\Models\AdminDeviceToken;
use App\Models\Tenant;
use App\Models\Client;
use App\Upload;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function Login(LoginRequest $request)
    {
        if (tenant()->paid == 0) {
            return ResponseHelper::make(null, __('dashboard.expired'), false, 404);
        }
        
        if (Auth('client')->attempt($request->only('phone', 'password') + ['deleted_at' => null, 'phone_code' => '+'.str_replace('+', '' ,$request->phone_code)])) {
            $Client = Auth('client')->user();
            $Client->DeviceTokens()->firstOrCreate([
                'device_token' => $request->device_token,
            ]);
            $success['token'] = $Client->createToken('ClientToken')->plainTextToken;
            $success['user'] = ClientResource::make($Client);
            $success['domain'] = NULL;

            return ResponseHelper::make($success, __('messages.loginSuccessfully'));
        }
        $Client = DB::connection('mysql')->table('clients')->where('phone',$request->phone)->first();
        if ($Client && tenant()->id == $Client->domain_name) {
            $Client = Client::create([
                'name' => $Client->name,
                'email' => $Client->email,
                'phone' => $Client->phone,
                'password' => $Client->password,
                'country_code' => $Client->country_code,
                'phone_code' => $Client->phone_code,
                'status' => 1,
            ]);
            $Client->DeviceTokens()->firstOrCreate([
                'device_token' => $request->device_token,
            ]);
            
            DB::table('admins_device_tokens')->insert([
                'device_token' => $request->device_token,
            ]);
            
            $success['token'] = $Client->createToken('ClientToken')->plainTextToken;
            $success['user'] = ClientResource::make($Client);
            $success['domain'] = NULL;
            return ResponseHelper::make($success, __('messages.loginSuccessfully'));
        }elseif($Client && tenant()->id != $Client->domain_name){
            AdminDeviceToken::firstOrCreate(['device_token' => $request->device_token]);
            $success['domain'] = $Client->domain_name . '.matjrbh.com';
            return ResponseHelper::make($success, 'Login Again');
        }
        return ResponseHelper::make(null, __('messages.emailPasswordIncorrect'), false, 404);
    }

    public function Register(RegisterRequest $request)
    {
        $phone_code = str_contains($request->phone_code, '+') ? $request->phone_code : '+'.$request->phone_code;
        $Client = Client::where('phone', $request->phone)->first();
        if (! $Client) {
            $Client = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request['password']),
                'country_code' => $request->country_code,
                'phone_code' => $phone_code,
                'status' => 1,
            ]);
        }
        $Client->DeviceTokens()->firstOrCreate([
            'device_token' => $request->device_token,
        ]);
        
        $Client->deleted_at = null;
        $Client->save();
        $success['token'] = $Client->createToken('ClientToken')->plainTextToken;
        $success['user'] = ClientResource::make($Client);

        return ResponseHelper::make($success, __('messages.User successfully Added'));
    }

    public function UpdateProfile(UpdateProfileRequest $request)
    {
        $phone_code = str_contains($request->phone_code, '+') ? $request->phone_code : '+'.$request->phone_code;
        $this->CheckAuth();
        $Client = Client::where('id', auth('sanctum')->id())->first();
        if ($Client) {
            $Client->update($request->only('phone', 'email', 'name', 'country_code', 'phone_code'));
            if ($request->phone_code) {
                $Client->update(['phone_code' => $phone_code]);
            }
            if ($request->password) {
                $Client->update(['password' => bcrypt($request['password'])]);
            }
            if ($request->image) {
                $Client->update(['image' => Upload::UploadFile($img, 'clients')]);
            }

            $success['token'] = $Client->createToken('ClientToken')->plainTextToken;
            $success['user'] = ClientResource::make($Client->refresh());

            return ResponseHelper::make($success, __('messages.User successfully Added'));
        } else {
            return ResponseHelper::make(null, __('messages.sorry_there_was_an_error'), false, 404);
        }
    }

    public function Sendotp($lang, OTPRequest $request)
    {
        $phone_code = str_contains($request->phone_code, '+') ? $request->phone_code : '+'.$request->phone_code;

        return ResponseHelper::make(WhatsApp::sendotp($phone_code.$request->phone));
    }

    public function CheckNumber($lang, CheckNumberRequest $request)
    {
        $Client = Client::whereNull('deleted_at')->where('phone', $request->phone)->first();
        $success['exist'] = $Client ? 1 : 0;
        $success['token'] = $Client ? $Client->createToken('ClientToken')->plainTextToken : null;
        $success['user'] = $Client ? ClientResource::make($Client) : null;

        return ResponseHelper::make($success);
    }

    public function forget($lang, LoginRequest $request)
    {
        $Client = Client::where('phone', $request->phone)->firstorfail();
        $Client->deleted_at = null;
        $Client->password = bcrypt($request['password']);
        $Client->save();
        $success['exist'] = $Client ? 1 : 0;
        $success['token'] = $Client ? $Client->createToken('ClientToken')->plainTextToken : null;
        $success['user'] = $Client ? ClientResource::make($Client) : null;

        return ResponseHelper::make($success);
    }

    public function changelang($lang)
    {
        $this->CheckAuth();
        $this->user->lang = $lang;
        $this->user->save();

        return ResponseHelper::make(null);
    }

    public function DeviceToken(DeviceTokenRequest $request)
    {
        $this->CheckAuth();
        $this->user->DeviceTokens()->create([
            'device_token' => $request->device_token,
        ]);
        $success['token'] = $this->user->createToken('ClientToken')->plainTextToken;
        $success['user'] = ClientResource::make($this->user);

        return ResponseHelper::make($success, __('messages.addedSuccessfully'));
    }

    public function Logout()
    {
        $this->CheckAuth();
        $this->user->DeviceTokens()->where('device_token', request()->device_token)->delete();
        $this->user->tokens()->where('token', request()->bearerToken())->delete();

        return ResponseHelper::make(null, __('messages.logoutSuccessfully'));
    }

    public function DeleteAccount()
    {
        if(request()->device_token){
            $this->CheckAuth();
            $this->user->DeviceTokens()->where('device_token', request()->device_token)->delete();
            $this->user->tokens()->delete();
            $this->user->delete();
        }elseif(request()->phone){
            $Client = Client::where('phone',request()->phone)->firstorfail();
            $Client->DeviceTokens()->delete();
            $Client->tokens()->delete();
            $Client->delete();
        }elseif(request()->client_id){
            $Client = Client::where('id',request()->client_id)->firstorfail();
            $Client->DeviceTokens()->delete();
            $Client->tokens()->delete();
            $Client->delete();
        }else{
            $this->CheckAuth();
            $this->user->tokens()->delete();
            $this->user->delete();
        }
        return ResponseHelper::make(null,__('trans.DeletedSuccessfully'));
    }
    
}
