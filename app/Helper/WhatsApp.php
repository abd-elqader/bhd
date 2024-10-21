<?php

namespace App\Helper;

class WhatsApp
{
    public static function SendOTP($phone)
    {
        $otp = rand(100000, 999999);
        $body = '';
        if(tenant())
            $body .= '%0a *' . ucfirst(tenant()->id) .' -  Matjr App* %0a';
        else
            $body .= '%0a *🔵 أهلا وسهلا ومرحبا بكم في 🔵* %0a';
            $body .= '%0a *منصة متجر*  %0a';
            $body .= '%0a *رمز التحقق* '.$otp.' %0a';


            $body .= '%0a *⬇ رابط الموقع ⬇*  %0a';
            $body .= '%0a http://Matjrbh.com %0a';


            $body .= '%0a *⬇*خطوات التسجيل وانشاء متجرك⬇*  %0a';
            $body .= '%0a https://youtu.be/0JAMgyW6hhQ?si=f7hLwO_UGX7LyGQX %0a';

            $body .= '%0a *⬇*خطوات التسجيل وانشاء متجرك⬇*  %0a';
            $body .= '%0a https://youtu.be/lf6V982ftfk?si=Lw6doGs_Y_9_hUF0 %0a';

            $body .= '%0a Powered By *Emcan Solutions*';
        self::SendWhatsApp($phone, $body);

        return $otp;
    }
    public static function GetToken() {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://emcan.bh/api/UltraCredentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => "token=zuvzajw7goMh20q5YVu0&domain=". $_SERVER['SERVER_NAME'],
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => [
                'content-type: application/x-www-form-urlencoded',
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return json_decode($response);
    }
    public static function SendWhatsApp($number, $message)
    {
        $EmcanWhats = self::GetToken();
        $instance = $EmcanWhats->instance;
        $token = $EmcanWhats->token;
        if($EmcanWhats->active){
            $number = str_replace('++', '+', $number);
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://api.ultramsg.com/'.$instance.'/messages/chat',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => "token=$token&to=$number&body=$message&priority=1&referenceId=",
                CURLOPT_HTTPHEADER => [
                    'content-type: application/x-www-form-urlencoded',
                ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        }
    }
    public static function SendOrder($Order)
    {
        $message = '%0a *An Order Has Been Placed By '.$Order->client->name.' ('.env('APP_NAME').')* %0a';
        $message .= '%0a *Order Number :* '.$Order->id;

        if ($Order->Branch) {
            $message .= '%0a *Branch :* '.$Order->Branch->title_en;
        }

        $message .= '%0a *Client Name :* '.$Order->client->name;
        $message .= '%0a *Client Number :* '.$Order->client->phone;
        $message .= '%0a *Order Time :* '.$Order->created_at;

        if ($Order->delivery_id == 1) {
            $address = $Order->address()->first();
            $message .= '%0a *Country :* '.$address->region->Country->title_en;
            if ($address->region->Country->id == 1) {
                $message .= '%0a *Region :* '.$address->region->title_en;
                $message .= '%0a *Block :* '.$address->block;
                $message .= '%0a *Road :* '.$address->road;
            } else {
                $message .= '%0a *City :* '.$address->region->title_en;
                $message .= '%0a *District :* '.$address->block;
                $message .= '%0a *Street :* '.$address->road;
            }
            $message .= '%0a *Building Number :* '.$address->building_no;
            $message .= '%0a *Floor Number :* '.$address->floor_no;
            $message .= '%0a *Apartment :* '.$address->apartment;
            $message .= '%0a *Type :* '.$address->type;
            $message .= '%0a *Additional Directions :* '.$address->additional_directions.' %0a';
        } elseif ($Order->delivery_id == 2) {
            $message .= '%0a *Type :* '.'Pick Up'.' %0a';
        }

        $message .= '%0a *Products :* ';
        foreach ($Order->OrderProducts as $item) {
            $message .= '%0a *Item :* '.str_replace('&', '-', $item->Product->title_en);
            $message .= '%0a *Size :* '.$item->Size->title_en;
            if ($item->Color) {
                $message .= '%0a *Color :* '.$item->Color->title_en;
            }
            $message .= '%0a *Price :* '.number_format(DefaultCurrancy()->currancy_value * $item->price, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
            $message .= '%0a *Quantity :* '.$item->quantity.'%0a';
        }
        
        $message .= '%0a *SubTotal :* '.number_format(DefaultCurrancy()->currancy_value * $Order->sub_total, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        if ($Order->discount > 0)
            $message .= '%0a *Discount :* '.number_format(DefaultCurrancy()->currancy_value * $Order->discount, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        if ($Order->vat > 0)
            $message .= '%0a *VAT ('.setting("VAT").') :* '.number_format(DefaultCurrancy()->currancy_value * $Order->vat, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        if ($Order->coupon > 0)
            $message .= '%0a *Coupon :* '.number_format(DefaultCurrancy()->currancy_value * $Order->coupon, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        if ($Order->charge_cost > 0)
            $message .= '%0a *Delivery Cost :* '.number_format(DefaultCurrancy()->currancy_value * $Order->charge_cost, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        $message .= '%0a *NetTotal :* '.number_format(DefaultCurrancy()->currancy_value * $Order->net_total, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        $message .= '%0a  %0a';

        $message .= '%0a '.setting('order_whatsapp_text_'.lang());
        $message .= '%0a *Powered By Emcan Solutions* %0a';

        if ($Order->delivery_id == 1) {
            $message .= '%0a  %0a';
            $message .= '%0a Tracking Link %0a'.$Order->client_tracking_link;
        }
        self::SendWhatsApp($Order->client->phone_code.$Order->client->phone, $message);
        self::SendWhatsApp(Setting('whatsapp'), $message);
    }
}
