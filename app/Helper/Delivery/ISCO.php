<?php

namespace App\Helper\Delivery;
use App\Models\Tenant\Branch;

class ISCO
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
    
        $Address = $Order->address()->first();
        $client_address_full =  'Block: ' . $Address->block . ' ,Road ' . $Address->road. ' ,Building: ' .$Address->building_no . ' ,Flat: ' .$Address->apartment . ' ,Additional:  '. preg_replace('/[^\x{0600}-\x{06FF}A-Za-z !@#$%^&*()]/u', '', $Address->additional_directions);
    
        $cash_need_to_be_collected = $Order->payment_id == 1 ? $Order->net_total : 0;
    
        $fields = (object) [];
    
        $fields->api_key = 'dfb0df772446d7a667ab301df2532112';
        $fields->order_id = (string)$Order->id;
        $fields->job_description = ucfirst(tenant()->id);
        
        $fields->job_pickup_phone = $Client->phone_code .  $Client->phone;
        $fields->job_pickup_name = $Client->name;
        $fields->job_pickup_email = $Client->email;
        
        $fields->job_pickup_address = $client_address_full;
        $fields->job_pickup_latitude = $Address->lang ?? $branch_long;
        $fields->job_pickup_longitude = $Address->lat ?? $branch_lat;
        
        $fields->job_pickup_datetime = date('Y-m-d H:i:s', strtotime('+60 minutes', strtotime(date('Y-m-d H:i:s'))));
        
        $fields->pickup_custom_field_template = 'Template_1';
        
        
        $fields->pickup_meta_data = collect();
        foreach($Order->OrderProducts as $key => $item){
            
            $data = (object) [];
            $data->label = "label";
            $data->data = $item->product->title();
            $fields->pickup_meta_data->push($data);
            
            $data = (object) [];
            $data->label = "Price";
            $data->data = $item->price;
            $fields->pickup_meta_data->push($data);
            
        }
        $fields->pickup_meta_data = array_values($fields->pickup_meta_data->toarray());
        
        $fields->team_id = "";
        $fields->auto_assignment = "0";
        $fields->has_pickup = "0";
        $fields->has_delivery = "1";
        $fields->layout_type = "0";
        $fields->tracking_link = 1;
        $fields->timezone = "300";
        $fields->fleet_id = "";
        
        $fields->p_ref_images = [];
        foreach($Order->OrderProducts as $key => $item){
            $fields->p_ref_images[] =  public_asset($item->product->RandomImage());
        }
        $fields->p_ref_images = array_values($fields->p_ref_images);
        
        $fields->notify = 1;
        $fields->tags = "";
        $fields->barcode =  "";
        $fields->geofence = 0;
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.tookanapp.com/v2/create_task");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $Task = json_decode(  str_replace(',}}', '}}',str_replace(' ', '', preg_replace('/[\x00-\x1F\x80-\xFF]/', '',$server_output))), true  );
        curl_close($ch);

        return $Task;
    }
}

