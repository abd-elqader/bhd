<?php

namespace App\Helper\Delivery;

use App\Models\Tenant\Branch;

class ShareMe
{
    public static function CreateTask($Order){

        $Branch = Branch::when($Order->branch_id, function ($query) use ($Order) {
            return $query->where('id', $Order->branch_id);
        })->first();

        $Client = $Order->client;
        $Address = $Order->address()->first();
        $total = $Order->payment_id == 1 ? $Order->net_total : 0;

        $fields = (object) [];
    
        $fields->is_paid = $total > 0  ? 1 : 0;
        $fields->paid_amount = $total;
        $fields->pickup_lat = $Branch->lat;
        $fields->pickup_long = $Branch->long;
        $fields->pickup_region = $Branch->address_en;
        $fields->deliver_lat = $Address->lat;
        $fields->deliver_long = $Address->long;
        $fields->deliver_region = $Address->region->title_en;
        $fields->details = '';
        $fields->currency = 'BHD';
        $fields->company = 'Matjar';
        $fields->images = [];
        $fields->name = $Client->name;
        $fields->phone = $Client->phone;
        $fields->email = $Client->email;
        foreach($Order->OrderProducts as $key => $item){
            $fields->details .= $item->product->title() . '  ,  ';
            $fields->images[] = asset($item->product->RandomImage());
        }
        $fields = json_encode($fields);
            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://shareme.emcan-group.com/api/en/client/add-matjr-order');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $Task = json_decode($server_output, true);
        // dd($Task);
        return $Task;
    }

}