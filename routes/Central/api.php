<?php

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([PreventAccessFromTenantDomains::class])->group(function () {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/admin/{id}', function ($id) {
        dd(Admin::find($id));
    });
});
