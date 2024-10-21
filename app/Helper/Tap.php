<?php

function VerifyTapTransaction($token, $bill_id = 1, $client_id = 1, $net = 0.010, $vat_added = 0, $amount = 0.010, $first_name = 'Emcan', $middle_name = 'Emcan', $last_name = 'Emcan', $user_phone = '33405497', $user_email = 'info@emcan-group.com', $currency = 'BHD', $redirect_url = 'https://matjrbh.com/payments/response' , $tap_src = 'src_all',$type = 'order')
{
    
    
    $fields = (object) (object) [];
    
    $fields->amount = (float)$net;
    $fields->currency = 'BHD';
    $fields->save_card = false;
    $fields->description = 'Description';
    $fields->statement_descriptor = 'Sample';
    
    $fields->metadata = (object) [];
    $fields->metadata->udf1 = $bill_id;
    
    $fields->reference = (object) [];
    $fields->reference->transaction = 'txn_0001';
    $fields->reference->order = 'ord_0001';
    
    $fields->receipt = (object) [];
    $fields->receipt->email = true;
    $fields->receipt->sms = true;
    
    $fields->customer = (object) [];
    $fields->customer->first_name = $first_name;
    $fields->customer->middle_name = '';
    $fields->customer->last_name = '';
    $fields->customer->email = $user_email ?? 'apps@emcan-group.com';
    $fields->customer->phone = (object) [];
    $fields->customer->phone->country_code = 973;
    $fields->customer->phone->number = $user_phone;
    
    $fields->merchant = (object) [];
    $fields->merchant->id = '';
    
    $fields->source = (object) [];
    $fields->source->id = $tap_src;
    
    $fields->post = (object) [];
    $fields->post->url = 'https://matjrbh.com';

    $fields->redirect = (object) [];
    $fields->redirect->url =  $redirect_url;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.tap.company/v2/charges',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>  json_encode($fields),
        CURLOPT_HTTPHEADER => array(': ','Authorization: Bearer '.$token,'Content-Type: application/json'),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo 'cURL Error #:'.$err;
    } else {
        $data = json_decode($response);
        $redirect = $data->transaction->url;
 
        try {
            DB::table('orders')->whereRaw('Date(created_at) = CURDATE()')->where('id', $bill_id)->update(array('transaction_number' => $data->id));
        } catch (\Exception $e) {
        
        }
        return $redirect;
        header("Location: $redirect");
    }
}

function ResponseTapTransaction($token, $charge_id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges/$charge_id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer " . $token
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        $response['status'] = 'cURL Error #:'.$err;
    }

    return json_decode($response, true);
}
