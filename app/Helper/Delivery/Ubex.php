<?php

namespace App\Helper\Delivery;

class Ubex
{
    public static function CreateTask($order){
        $payment = $order->payment;
        $delivery = $order->delivery;
        $client = \App\Models\Client::find($order->client_id);
        $address = $client->addresses->where('id',$order->address_id)->first();
        $block = $address->block()->first();
        $region = $address->region;
        $country = $region->country()->first();
        $branch = $order->Branch()->first();
        
        $parcel_value = $order->payment_id == 1 ? floatval($order->net_total) : 0;
        $declared_value = floatval($order->net_total);
        if($country->id ==1){
            $area = $block ? $block->uuid : 'df2dab77-8e9c-491c-82f8-00880f84bb2e';
        }else{
            $area = $region ? $region->uuid : 'df2dab77-8e9c-491c-82f8-00880f84bb2e';
        }
        
        $data = [
            "token" => env('UBEX_TOKEN'),
            "test"=> "1",
            "is_product"=> false,
            "address_from"=> "16083817-2b2a-44d1-9e37-80cf7b9d4b39",
            "mobile"=> str_replace("+", "",  $country->phone_code . $client->phone ),
            "first_name"=> explode(' ', $client->name)[0] ?? null,
            "last_name"=> explode(' ', $client->name)[1] ?? ' Matjr',
            "email"=> $client->email,
            "area"=> $area,
            "building"=> $address->building_no,
            "road"=> $address->road,
            "address_line_1"=> "Floor : " . $address->floor_no . ", Apartment : " . $address->apartment . ", Type : " . $address->type,
            "address_line_2"=> "Additional Directions : " . $address->additional_directions,
            "country"=> $country->country_code,
            "base_product"=> $country->ubex_products,
            "other_products"=> $order->payment_id == 1 ? ["120cb1d5-6722-430e-aa03-40cd2d1fac5e"] : [],
            "type"=> "dox",
            "bill_to"=> "receiver",
            "bill_duties_to"=> "receiver",
            "content"=> env('APP_NAME') . ' ' . ucfirst(tenant()->id),
            "parcel_value"=> $parcel_value,
            "parcel_currency"=> $country->currancy_code,
            "declared_value"=> $declared_value,
            "declared_currency"=> $country->currancy_code,
            "shipment_reference"=> $order->id,
            "paid"=> $order->payment_id == 1 ? 0 : 1,
            "pieces"=> [
                [
                    "weight"=> "1",
                    "length"=> "1",
                    "width"=> "1",
                    "height"=> "1",
                    "qty"=> $order->OrderProducts()->sum('quantity'),
                    "value"=> $order->sub_total,
                    "content"=> "products"
                ]
            ]
        ];
        $GuzzleHttpClient = new \GuzzleHttp\Client();
        $client_response = $GuzzleHttpClient->post('https://ubex-clients.apis.delivery/api/v2/shipments/create', [
            \GuzzleHttp\RequestOptions::JSON => $data
        ]);
        $Task =  json_decode($client_response->getBody(),true);

        return $Task;
    }
    
    
    public static function CreateAddress($branch_id){
        $branch = \App\Models\Tenant\Branch::find($branch_id);
        $country = \App\Models\Country::find($branch->country_id);
        $data = [
            "token" => env('UBEX_TOKEN'),
            "area"=> $branch->ubex_area,
            "phone"=> $branch->phone,
            "title"=> $branch->title_en,
            "extra_dir"=> $branch->address_en,
            "country_code"=> $country->country_code,
            "building"=> "",
            "floor"=> "1",
            "unit"=> "1",
            "road"=> "1",
    
        ];
        $GuzzleHttpClient = new \GuzzleHttp\Client();
        $client_response = $GuzzleHttpClient->post('https://ubex-clients.apis.delivery/api/address/new', [
            \GuzzleHttp\RequestOptions::JSON => $data
        ]);
        return json_decode($client_response->getBody(),true);
    }
    
    public static function AccountInfo(){
        $GuzzleHttpClient = new \GuzzleHttp\Client();
        $client_response = $GuzzleHttpClient->get('https://ubex-clients.apis.delivery/api/account/info', [
            \GuzzleHttp\RequestOptions::JSON => [
                "token" => env('UBEX_TOKEN'),
            ]
        ]);
        return json_decode($client_response->getBody(),true);
    }
}