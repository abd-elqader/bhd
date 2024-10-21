<?php

namespace App\Helper\Delivery;

use App\Models\Tenant\Branch;

class Delybell
{
    public static function CreateTask($Order)
    {

        $Payment = $Order->payment;
        $Delivery = $Order->delivery;
        $Client = \App\Models\Client::find($Order->client_id);

        // Fetch the address and associated details
        $Address = $Client->addresses->where('id', $Order->address_id)->first();
        $Block = $Address->block()->first();
        $Region = $Address->region;
        $Country = $Region->country()->first();
        $Branch = $Order->Branch()->first() ?? Branch::first();

        // Determine parcel value based on payment method
        $parcel_value = $Order->payment_id == 1 ? floatval($Order->net_total) : 0;
        $declared_value = floatval($Order->net_total);

        // Build Address lines
        $AddressLine1 = '';
        if ($Address->floor_no) {
            $AddressLine1 .= __('dashboard.floor_no') . " : " . $Address->floor_no;
        }
        if ($Address->apartment) {
            $AddressLine1 .= " " . __('website.apartmentNo') . " : " . $Address->apartment;
        }
        if ($Address->type) {
            $AddressLine1 .= " " . __('website.type') . " : " . $Address->type;
        }
        if ($Address->additional_directions) {
            $AddressLine1 .= " " . __('website.additionalDirection') . " : " . $Address->additional_directions;
        }



        $curl = curl_init();
        
        $params = array(
            "api_token" => "14571669158853467315596185781971018561",
            "delivery_type" => 4,
            "total_weight" => 1,
            "boxcount" => 1,
            "amountFinal" => (float)$parcel_value,
            "amount" => (float)$declared_value,
            "total_deliverycharge" => (float)$Order->charge_cost,
            "remark" => $Order->note,
            
            "p_name" => $Branch->title_en,
            "p_phone" => $Branch->phone,
            "p_flat" => $Branch->apartment,
            "p_city" => $Branch->address_en,
            "p_building" => $Branch->building_no,
            "p_road_no" => $Branch->road,
            "p_block_no" =>  $Branch->block,
            "p_area" => $Branch->address_en,
            "p_location" => $Branch->lat .','.$Branch->long,
            
            "d_name" => $Client->name,
            "d_phone" => $Client->phone,
            "d_building" => $Address->building_no,
            "d_road_no" => $Address->road,
            "d_block_no" => $Address->block,
            "d_city" => $Region->title_en,
            "d_location" => $AddressLine1,
            
            "from_lat" => $Branch->lat,
            "from_lng" => $Branch->long,
            
            "to_lat" => $Address->lat,
            "to_lng" => $Address->long,
            
            "user_selected_pickupdate" => now()->format('Y-m-d'),
            "user_selected_pickup_time" => "01PM",
            
            "user_selected_delivery_date" => now()->addDays(1)->format('Y-m-d'),
            "user_selected_delivery_time" => "01PM",
        );
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://delybell.com/api/home/apiOrderAdd',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: ci_session=q5dt5ao68sjndj7sjk1sj9pn823458cd'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        $Task = json_decode($response, true);

        return $Task;
                

    }

}