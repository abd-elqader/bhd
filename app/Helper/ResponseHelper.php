<?php

namespace App\Helper;

use App\Models\Tenant\Cart;
use App\Models\Tenant\Address;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ResponseHelper
{
    public static function make($data, $msg = '', $success = true, $statusCode = 200)
    {
        $Cart = [];
        if (auth('sanctum')->check()) {
            $query = Cart::where('client_id', auth('sanctum')->id())->get();
            $subTotal = 0.000;
            $discount = 0.000;
            $total_after_discount = 0.000;
            foreach ($query as $CartItem) {
                $subTotal += $CartItem->total_after_discount;
            }
            $discount_value = number_format($subTotal * setting('discount') / 100, DefaultCurrancy()->decimals, '.', '');
            $VAT_value = number_format(($subTotal - $discount_value) * setting('VAT') / 100, DefaultCurrancy()->decimals, '.', '');
            $delivery_cost_value = 0.000;
            if (request('delivery_id') == 1 && $subTotal > 0) {
                $Address = Address::where('id', request('address_id'))->first();
                if(!$Address){
                    $Address = Address::where('client_id', auth('sanctum')->id())->orderBy('id','desc')->first();
                }
                $Branches = [];
                foreach(Branches() as $Branch){
                    $Branches[] = [
                        'distance' => distance($Address->lat,$Address->long,$Branch->lat,$Branch->long),
                        'branch' => $Branch,
                    ];
                }
                $ShortBranch = collect($Branches)->sortBy('distance')->first();
                $Branch = $ShortBranch['branch'];
                
                $delivery_cost_value = delivery_cost($Address->lat,$Address->long,$Branch->lat,$Branch->long,request('same_day_price'),$ShortBranch['distance']);
            }
            $Cart['quantity'] = $query->count('quantity');
            $Cart['subTotal'] = number_format($subTotal, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
            $Cart['netTotal'] = number_format(($subTotal + $VAT_value - $discount_value + $delivery_cost_value), DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        }
        

        throw new HttpResponseException(response()->json([
            'msg' => $msg,
            'statusCode' => $statusCode,
            'success' => $success,
            'cart_details' => (object) $Cart,
            'payload' => in_array(Route::currentRouteName(), ['cart.index']) ? (object) $data : $data,
            'custum_mobile' => custum_mobile(),
        ], $statusCode));
    }

    public static function send_notification($message, $data, $client_id = null)
    {
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='.env('FCM');
        foreach (\App\Models\DeviceToken::when($client_id > 0, function ($query) use ($client_id) {
            return $query->where('client_id', $client_id);
        })->pluck('device_token') as $token) {
            $notification = [
                'to' => $token,
                'notification' => [
                    'title' => env('APP_NAME'),
                    'body' => $message,
                    'sound' => 'default',
                    'badge' => '1',
                ],
                'priority' => 'high',
                'data' => $data,
                'content_available' => true,
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
            $response = curl_exec($ch);
            if ($response === false) {
                \Illuminate\Support\Facades\Log::debug('FCM Send Error: '.curl_error($ch));
                exit('FCM Send Error: '.curl_error($ch));
            }
            curl_close($ch);
        }
    }
    public static function send_notification_for_new_order()
    {
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='.env('FCM');
        foreach (\App\Models\AdminDeviceToken::pluck('device_token') as $token) {
            $notification = [
                'to' => $token,
                'notification' => [
                    'title' => env('APP_NAME'),
                    'body' => 'New Order Added',
                    'sound' => 'default',
                    'badge' => '1',
                ],
                'priority' => 'high',
                'data' => [
                    'type' => 'new_order'
                ],
                'content_available' => true,
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
            $response = curl_exec($ch);
            if ($response === false) {
                \Illuminate\Support\Facades\Log::debug('FCM Send Error: '.curl_error($ch));
                exit('FCM Send Error: '.curl_error($ch));
            }
            curl_close($ch);
        }
    }
}
