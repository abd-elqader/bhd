<?php

use App\Http\Controllers\Mix\webController;
use App\Http\Middleware\PreventAccessFromTenantDomains;
use App\Models\Client;
use App\Mail\MailSummary;
use App\Models\Tenant;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::middleware([PreventAccessFromTenantDomains::class])->group(function () {
    Route::any('get-ip-details', [webController::class, 'ip'])->name('ip');
    Route::any('switch', [webController::class, 'switch'])->name('switch');
    Route::any('reorder', [webController::class, 'reorder'])->name('reorder');
    Route::any('language/{locale}', [webController::class, 'lang'])->name('lang');
    Route::any('sendotp/{number}', [webController::class, 'SendOTP'])->name('SendOTP');
    Route::any('removeids', [webController::class, 'RemoveIds'])->name('RemoveIds');
    Route::any('switchTheme', [webController::class, 'switchTheme'])->name('switchTheme');
    Route::any('artisan/{command}', [webController::class, 'artisan'])->name('artisan');
});
    