<?php

namespace App\Helper\Delivery;

use App\Models\Tenant\Branch;

class SMSA
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
        $AddressLine2 = '';
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
            $AddressLine2 .= " " . __('website.additionalDirection') . " : " . $Address->additional_directions;
        }

        // Construct Consignee Address object
        $ConsigneeAddress = (object) [
            'ContactName' => $Client->name,
            'ContactPhoneNumber' => str_replace("+", "", $Country->phone_code . $Client->phone),
            'Coordinates' => $Address->lat . ',' . $Address->long,
            'Country' => $Country->country_code,
            'District' => $Block?->title() ?? $Address->block,
            'PostalCode' => '',
            'City' => $Region->title(),
            'AddressLine1' => $AddressLine1,
            'AddressLine2' => $AddressLine2,
        ];

        // Construct Shipper Address object
        $ShipperAddress = (object) [
            'ContactName' => $Branch->title(),
            'ContactPhoneNumber' => str_replace("+", "", $Branch->phone),
            'Coordinates' => $Branch->lat . ',' . $Branch->long,
            'Country' => $Branch->Country->country_code,
            'District' => $Branch->address(),
            'PostalCode' => '',
            'City' => $Branch->address(),
            'AddressLine1' => $Branch->address(),
            'AddressLine2' => '',
        ];

        // Prepare the data for API request
        $data = [
            'ConsigneeAddress' => $ConsigneeAddress,
            'ShipperAddress' => $ShipperAddress,
            'OrderNumber' => (string) $Order->id,
            'DeclaredValue' => $declared_value,
            'CODAmount' => $parcel_value,
            'Parcels' => 1,
            'ShipDate' => now()->format('Y-m-d\TH:i:s'), // ISO format
            'ShipmentCurrency' => 'BHD',
            'SMSARetailID' => '0',
            'WaybillType' => 'PDF',
            'Weight' => 1,
            'WeightUnit' => 'KG',
            'ContentDescription' => '',
            'VatPaid' => true,
            'DutyPaid' => true,
            'ServiceCode' => 'EIDL',
        ];

        // Debugging purpose only; remove in production

        // Send the data to the API
            dd(json_encode($data));
        $GuzzleHttpClient = new \GuzzleHttp\Client();
        $client_response = $GuzzleHttpClient->post('https://ecomapis-sandbox.azurewebsites.net/api/shipment/b2c/new', [
            'headers' => [
                'apikey' => 'de777bfd85c0491a948b84e378817cc6', // Replace with your actual API key
                'Content-Type' => 'application/json'
            ],
            \GuzzleHttp\RequestOptions::JSON => $data
        ]);

        // Decode the response and return
        $Task = json_decode($client_response->getBody(), true);
        
        return $Task;
        

    }

}