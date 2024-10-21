<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mix\Admin\ThemeController;
use App\Http\Controllers\Mix\Admin\ThemePageController;
use App\Http\Controllers\Tenant\User\AddressController;
use App\Http\Controllers\Tenant\User\AuthController;
use App\Http\Controllers\Tenant\User\CartController;
use App\Http\Controllers\Tenant\User\IndexController;
use App\Http\Controllers\Tenant\User\Payment\CreditController;
use App\Http\Controllers\Tenant\User\Payment\DebitController;
use App\Http\Controllers\Tenant\User\Payment\TapController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Middleware\ForceSSL;

Route::group(['middleware' => [ForceSSL::class]], function () {
    Route::middleware([InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class])->group(function () {
        Route::get('/send/mail', function () {
            // Artisan::call('config:cache');
            // dd(Config::get('mail.mailers.smtp.username'),Config::get('mail.from.address'));
            Mail::to(['mostafazarea69@gmail.com'])->send(new \App\Mail\OrderSummary(\App\Models\Tenant\Order::first()));
        });
    
        Route::group(['as' => 'client.'], function () {
            Route::any('/', [IndexController::class, 'index'])->name('home');
            
            Route::any('expired', [IndexController::class, 'expired'])->name('expired');
    
            Route::any('cart', [IndexController::class, 'cart'])->name('cart');
            Route::any('product/{product}', [IndexController::class, 'product'])->name('product');
            Route::any('categories/{category_id?}', [IndexController::class, 'categories'])->name('categories');
            Route::any('addReview', [IndexController::class, 'addReview'])->name('addReview');
    
            Route::middleware([\App\Http\Middleware\UnAuthenticateClient::class])->group(function () {
                Route::GET('login', [IndexController::class, 'login'])->name('login');
                Route::POST('login', [AuthController::class, 'login'])->name('login');
                Route::GET('register', [IndexController::class, 'register'])->name('register');
                Route::POST('register', [AuthController::class, 'register'])->name('register');
                Route::GET('forget', [IndexController::class, 'forget'])->name('forget');
                Route::POST('forget', [AuthController::class, 'forget'])->name('forget');
            });
    
            Route::middleware([\App\Http\Middleware\AuthenticateClient::class])->group(function () {
                Route::GET('profile/{type?}', [IndexController::class, 'profile'])->name('profile');
                Route::POST('profile/{type?}', [AuthController::class, 'profile'])->name('profile');
                Route::any('logout', [AuthController::class, 'logout'])->name('logout');
                Route::resource('address', AddressController::class);
            });
    
            Route::any('faq', [IndexController::class, 'FAQ'])->name('faq');
            Route::any('about', [IndexController::class, 'About'])->name('about');
            Route::any('terms', [IndexController::class, 'Terms'])->name('terms');
            Route::any('contact', [IndexController::class, 'Contact'])->name('contact');
            Route::any('privacy', [IndexController::class, 'Privacy'])->name('privacy');
            Route::any('Returns', [IndexController::class, 'Returns'])->name('Returns');
            Route::any('post_subscribe', [IndexController::class, 'post_subscribe'])->name('post_subscribe');
            Route::any('post_contact', [IndexController::class, 'post_contact'])->name('post_contact');
    
            Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
                Route::group(['prefix' => 'tap', 'as' => 'tap.'], function () {
                    Route::any('response', [TapController::class, 'response'])->name('response'); // client.payment.tap.response
                });
                Route::group(['prefix' => 'debit', 'as' => 'debit.'], function () {
                    Route::any('init', [DebitController::class, 'init'])->name('init'); // client.payment.debit.init
                    Route::any('response', [DebitController::class, 'response'])->name('response'); // client.payment.debit.response
                    Route::any('success', [DebitController::class, 'success'])->name('success'); // client.payment.debit.success
                    Route::any('error', [DebitController::class, 'error'])->name('error'); // client.payment.debit.error
                });
    
                Route::group(['prefix' => 'credit', 'as' => 'credit.'], function () {
                    Route::any('init', [CreditController::class, 'init'])->name('init');
                    Route::any('response', [CreditController::class, 'response'])->name('response');
                });
            });
        });
    
        Route::any('ChangeDefaultCurrancy/{id}', [IndexController::class, 'ChangeDefaultCurrancy'])->name('ChangeDefaultCurrancy');
        Route::any('previewThemePage', [ThemePageController::class, 'previewThemePage'])->name('previewThemePage');
        Route::any('previewFullThemePage/{id}', [ThemePageController::class, 'previewFullThemePage'])->name('previewFullThemePage');
        Route::any('previewDefaultFullThemePage/{id}', [ThemePageController::class, 'previewDefaultFullThemePage'])->name('previewDefaultFullThemePage');
        Route::any('previewTheme', [ThemeController::class, 'previewTheme'])->name('previewTheme');
        Route::any('previewFullTheme/{id}', [ThemeController::class, 'previewFullTheme'])->name('previewFullTheme');
    
        Route::any('sizeColorFilter', [CartController::class, 'sizeColorFilter'])->name('sizeColorFilter');
        Route::any('addToCart', [CartController::class, 'addToCart'])->name('addToCart');
        Route::any('cartPlus', [CartController::class, 'CartPlus'])->name('cartPlus');
        Route::any('cartMinus', [CartController::class, 'CartMinus'])->name('cartMinus');
        Route::any('cartDestroy', [CartController::class, 'cartDestroy'])->name('cartDestroy');
    
        Route::any('coupon', [IndexController::class, 'coupon'])->name('coupon');
        Route::any('checkout', [IndexController::class, 'checkout'])->name('checkout');
        Route::any('confirmOrder', [IndexController::class, 'confirmOrder'])->name('confirmOrder');
        Route::GET('addToFavorites', [IndexController::class, 'addToFavorites'])->name('addToFavorites');
        
        Route::any('country_regions/{category_id}', [IndexController::class, 'CountryRegions'])->name('CountryRegions');
        Route::any('region_cities/{region_id}', [IndexController::class, 'RegionCities'])->name('RegionCities');
    });
});
