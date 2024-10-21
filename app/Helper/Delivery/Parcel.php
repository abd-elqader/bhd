<?php

namespace App\Helper\Delivery;

use App\Models\Tenant\Branch;

class Parcel
{
    public static function CreateTask($Order){
        $branch_id = $Order->branch_id;
        $client_id = $Order->client_id;
        $payment_method = $Order->payment()->first()->title(); //cash
        $client_address_id = $Order->address_id;
    
        $Branch = Branch::when($Order->branch_id, function ($query) use ($Order) {
            return $query->where('id', $Order->branch_id);
        })->first();
        $branch_name = $Branch->title();
        $branch_lat = $Branch->lat ?? '26.2247938';
        $branch_long = $Branch->long ?? '50.5082573';
        $branch_address = $Branch->address();
        $branch_email = $Branch->email;
        $branch_phone = $Branch->phone;
    
        $Client = $Order->client;
        $client_name = $Client->name;
        $client_phone = $Client->phone;
        $client_email = $Client->email;
    
        $Address = $Order->address()->first();
        $address_longitude = $Address->lang ?? $branch_long;
        $address_latitude = $Address->lat ?? $branch_lat;
        $block = $Address->block;
        $road = $Address->road;
        $building = $Address->building_no;
        $flat = $Address->apartment;
        $address_special_inst = preg_replace('/[^\x{0600}-\x{06FF}A-Za-z !@#$%^&*()]/u', '', $Address->additional_directions);
        $client_address_full = $block.$road.$building.$flat;
    
        $cash_need_to_be_collected = $Order->payment_id == 1 ? $Order->net_total : 0;
    
        $fields = (object) [];
    
        $fields->vehicle = 'van';
        $fields->pickup = (object) [];
        $fields->pickup->time = date('Y-m-d\TH:i:sp', strtotime('+60 minutes', strtotime(date('Y-m-d H:i:s'))));
        $fields->pickup->instant = false;
        $fields->pickup->address = (object) [];
        $fields->pickup->address->fullAddress = $branch_address;
        $fields->pickup->address->specialInstruction = '';
        $fields->pickup->address->location = (object) [];
        $fields->pickup->address->location->lat = (float) $branch_lat;
        $fields->pickup->address->location->lng = (float) $branch_long;
    
        $fields->deliveries = [];
        $fields->deliveries[0] = (object) [];
        $fields->deliveries[0]->name = $branch_name;
        $fields->deliveries[0]->phone = $branch_phone;
        $fields->deliveries[0]->address = (object) [];
        $fields->deliveries[0]->address->fullAddress = $client_address_full;
        $fields->deliveries[0]->address->specialInstruction = $address_special_inst;
        $fields->deliveries[0]->address->location = (object) [];
        $fields->deliveries[0]->address->location->lat = (float) $address_latitude;
        $fields->deliveries[0]->address->location->lng = (float) $address_longitude;
        $fields->deliveries[0]->address->accurate = true;
        $fields->deliveries[0]->notes = '-';
        $fields->deliveries[0]->orderId = (string) $Order->id;
    
        $fields = json_encode($fields);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://auth.tryparcel.com/api/v4/task');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: '.self::generateToken($branch_id)]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $Task = json_decode($server_output, true);

        return $Task;
    }
    
    
    public static function generateToken($branch_id){
        $id = trim(env('PARCEL_ID'));
        $secret = trim(env('PARCEL_SECRET'));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://auth.tryparcel.com/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials&scope=api/test');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded', 'Authorization: Basic '.base64_encode("$id:$secret")]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        $access_token = $server_output['access_token'];
        return $access_token;
    }

}