<?php

use App\Http\Controllers\Central\User\AuthController;
use App\Http\Controllers\Central\User\IndexController;
use App\Http\Controllers\Central\User\TapController;
use App\Http\Livewire\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateClient;
use App\Http\Middleware\UnAuthenticateClient;
use App\Http\Middleware\PreventAccessFromTenantDomains;
use App\Http\Middleware\ForceSSL;

            
Route::group(['middleware' => [ForceSSL::class]], function () {
    Route::middleware([PreventAccessFromTenantDomains::class])->group(function () {
        Route::group(['as' => 'client.'], function () {
            
            Route::GET('delayedRedirect', [IndexController::class, 'index'])->name('home');
            Route::GET('/', [IndexController::class, 'index'])->name('home');
            Route::any('blogs', [IndexController::class, 'blogs'])->name('blogs');
            Route::any('blog/{title}', [IndexController::class, 'blog'])->name('blog');
            Route::any('pricing', [IndexController::class, 'pricing'])->name('pricing');
    
            Route::any('faq', [IndexController::class, 'FAQ'])->name('faq');
            Route::any('about', [IndexController::class, 'About'])->name('about');
            Route::any('terms', [IndexController::class, 'Terms'])->name('terms');
            Route::any('contact', [IndexController::class, 'Contact'])->name('contact');
            Route::any('privacy', [IndexController::class, 'Privacy'])->name('privacy');
            Route::any('Returns', [IndexController::class, 'Returns'])->name('Returns');
            
            Route::any('post_subscribe', [IndexController::class, 'post_subscribe'])->name('post_subscribe');
            Route::any('post_contact', [IndexController::class, 'post_contact'])->name('post_contact');
            
            Route::any('payments/response', [TapController::class, 'payment_response'])->name('payment-response');
            
            Route::middleware([UnAuthenticateClient::class])->group(function () {
                Route::GET('login', [IndexController::class, 'login'])->name('login');
                Route::POST('login', [AuthController::class, 'login'])->name('login');
                Route::GET('register', [IndexController::class, 'register'])->name('register');
                Route::POST('register', [AuthController::class, 'register'])->name('register');
                Route::GET('forget', [IndexController::class, 'forget'])->name('forget');
                Route::POST('forget', [AuthController::class, 'forget'])->name('forget');
            });
    
            Route::middleware([AuthenticateClient::class])->group(function () {
                
                Route::any('renew', [IndexController::class, 'renew'])->name('renew');
                Route::any('post_renew', [IndexController::class, 'post_renew'])->name('post_renew');
                
                Route::GET('profile', Profile::class)->name('profile');
                Route::any('logout', [AuthController::class,'logout'])->name('logout');
            });
    
        });
    });
});


Route::get('timeout', function (Illuminate\Http\Request $request) {
    $finalUrl = $request->query('url');
    return view('Central.User.timeout', ['finalUrl' => $finalUrl]);
})->name('timeout');