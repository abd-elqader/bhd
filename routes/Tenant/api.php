<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\API\AddressController;
use App\Http\Controllers\Tenant\API\AuthController;
use App\Http\Controllers\Tenant\API\BranchController;
use App\Http\Controllers\Tenant\API\CartController;
use App\Http\Controllers\Tenant\API\CategoryController;
use App\Http\Controllers\Tenant\API\ColorController;
use App\Http\Controllers\Tenant\API\ComplaintsController;
use App\Http\Controllers\Tenant\API\CountryController;
use App\Http\Controllers\Tenant\API\DeliveryController;
use App\Http\Controllers\Tenant\API\FavouriteController;
use App\Http\Controllers\Tenant\API\HomeController;
use App\Http\Controllers\Tenant\API\MessagesController;
use App\Http\Controllers\Tenant\API\MessageTypesController;
use App\Http\Controllers\Tenant\API\NotificationController;
use App\Http\Controllers\Tenant\API\OrderController;
use App\Http\Controllers\Tenant\API\PaymentController;
use App\Http\Controllers\Tenant\API\ProductController;
use App\Http\Controllers\Tenant\API\ProductReviewsController;
use App\Http\Controllers\Tenant\API\RegionController;
use App\Http\Controllers\Tenant\API\CityController;
use App\Http\Controllers\Tenant\API\SettingController;
use App\Http\Controllers\Tenant\API\SizeController;
use App\Http\Controllers\Tenant\API\SliderController;
use App\Http\Controllers\Tenant\API\WeightController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class])->group(function () {
    Route::prefix('{lang}')->group(function ($lang) {
        Route::any('home', [HomeController::class, 'index']);
        Route::apiResource('addresses', AddressController::class);
        Route::apiResource('favourite', FavouriteController::class);
        Route::apiResource('complaints', ComplaintsController::class);
        Route::apiResource('message-types', MessageTypesController::class);
        Route::apiResource('messages', MessagesController::class);
        Route::apiResource('branches', BranchController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('products', ProductController::class);
        Route::apiResource('reviews', ProductReviewsController::class);
        Route::apiResource('countries', CountryController::class);
        Route::apiResource('regions', RegionController::class);
        Route::apiResource('cities', CityController::class);
        Route::apiResource('sliders', SliderController::class);
        Route::apiResource('payments', PaymentController::class);
        Route::apiResource('deliveries', DeliveryController::class);
        Route::apiResource('sizes', SizeController::class);
        Route::apiResource('colors', ColorController::class);
        Route::apiResource('weights', WeightController::class);
        Route::apiResource('cart', CartController::class);
        Route::apiResource('order', OrderController::class);
        Route::apiResource('notification', NotificationController::class);

        Route::any('settings ', [SettingController::class, 'settings']);
        Route::any('google_ads ', [SettingController::class, 'google_ads']);
        Route::any('contact ', [SettingController::class, 'contact']);
        Route::any('privacy', [SettingController::class, 'privacy']);
        Route::any('about ', [SettingController::class, 'about']);
        Route::any('terms ', [SettingController::class, 'terms']);
        Route::any('support ', [SettingController::class, 'support']);

        Route::any('user', [AuthController::class, 'user']);

        Route::any('login', [AuthController::class, 'Login']);
        Route::any('register', [AuthController::class, 'Register']);
        Route::any('profile', [AuthController::class, 'UpdateProfile']);
        Route::any('logout', [AuthController::class, 'Logout']);
        Route::any('delete-account', [AuthController::class, 'DeleteAccount']);
        Route::any('sendotp', [AuthController::class, 'Sendotp']);
        Route::any('check_number', [AuthController::class, 'CheckNumber']);
        Route::any('forget', [AuthController::class, 'forget']);
        Route::any('check', [CartController::class, 'check']);
        Route::any('tokens', [AuthController::class, 'DeviceToken']);
        Route::any('changelang', [AuthController::class, 'changelang']);
        
        
        Route::any('payment/success', [PaymentController::class,'success']);
        Route::any('payment/failed', [PaymentController::class,'failed']);
    });
});
