<?php

declare(strict_types=1);

use App\Http\Controllers\Mix\webController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class])->group(function () {
    Route::any('get-ip-details', [webController::class, 'ip'])->name('ip');
    Route::any('switch', [webController::class, 'switch'])->name('switch');
    Route::any('reorder', [webController::class, 'reorder'])->name('reorder');
    Route::any('language/{locale}', [webController::class, 'lang'])->name('lang');
    Route::any('sendotp/{number}', [webController::class, 'SendOTP'])->name('SendOTP');
    Route::any('removeids', [webController::class, 'RemoveIds'])->name('RemoveIds');
    Route::any('switchTheme', [webController::class, 'switchTheme'])->name('switchTheme');
    Route::any('artisan/{command}', [webController::class, 'artisan'])->name('artisan');
    Route::any('smsa', function(){
        return Smsa::CreateShipment(112);
    });
    
    // Route::any('migrate', function(){
    //     \Artisan::call('tenants:migrate', [
    //         '--tenants' => [tenant()->id],
    //     ]);
    //     print_r(\Artisan::output());
    // });
    // Route::any('migrate-fresh', function(){
    //     \Artisan::call('tenants:migrate-fresh', [
    //         '--tenants' => [tenant()->id],
    //     ]);
    //     print_r(\Artisan::output());
    // });
    // Route::any('Ubex', function(){
    //     $data = [];
    //     $GuzzleHttpClient = new \GuzzleHttp\Client();
    //     $client_response = $GuzzleHttpClient->get('https://ubex-clients.apis.delivery/api/meta/regions/f2144b82-bd59-43f1-ae99-08ab3845a73a', [
    //         \GuzzleHttp\RequestOptions::JSON => ["token" => env('UBEX_TOKEN')]
    //     ]);
    //     foreach(json_decode((string)$client_response->getBody(),true)['data'] as $region){
    //         $region_item = [];
    //         $region_item['country_id'] = 2;
    //         $region_item['title_en'] = $region['name'];
    //         $region_item['uuid'] = $region['uuid'];
    //         $data[] = $region_item;
    //         // $client_response = $GuzzleHttpClient->get('https://ubex-clients.apis.delivery/api/meta/cities/'.$region['uuid'], [
    //         //     \GuzzleHttp\RequestOptions::JSON => ["token" => env('UBEX_TOKEN')]
    //         // ]);
    //         // foreach(json_decode((string)$client_response->getBody(),true)['data'] as $region){
    //         //     $region_item = [];
    //         //     $region_item['country_id'] = 2;
    //         //     $region_item['title_en'] = $region['name'];
    //         //     $region_item['uuid'] = $region['uuid'];
    //         //     $data[] = $region_item;
    //         // }
    //     }
    //     \App\Models\Region::insert($data);
    // });
});
