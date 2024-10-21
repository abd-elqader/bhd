<?php

use App\Http\Controllers\Central\Admin\ReportController;
use App\Http\Controllers\Central\Admin\BlogController;
use App\Http\Controllers\Central\Admin\ClientsController;
use App\Http\Controllers\Central\Admin\ComponentController;
use App\Http\Controllers\Central\Admin\DefaultThemeController;
use App\Http\Controllers\Central\Admin\DefaultThemePageController;
use App\Http\Controllers\Central\Admin\FeatureController;
use App\Http\Controllers\Central\Admin\FeatureHeaderController;
use App\Http\Controllers\Central\Admin\MailController;
use App\Http\Controllers\Central\Admin\HomeController;
use App\Http\Controllers\Central\Admin\PackageController;
use App\Http\Controllers\Central\Admin\PackageDescController;
use App\Http\Controllers\Central\Admin\StoresController;
use App\Http\Controllers\Central\Admin\TenantsController;
use App\Http\Controllers\Central\Admin\DeliveryController;
use App\Http\Controllers\Mix\Admin\AdminsController;
use App\Http\Controllers\Mix\Admin\AgentsController;
use App\Http\Controllers\Mix\Admin\ContactController;
use App\Http\Controllers\Mix\Admin\CountryController;
use App\Http\Controllers\Mix\Admin\FAQController;
use App\Http\Controllers\Mix\Admin\ImagesController;
use App\Http\Controllers\Mix\Admin\ImageTypeController;
use App\Http\Controllers\Mix\Admin\NavbarController;
use App\Http\Controllers\Mix\Admin\PaymentsController;
use App\Http\Controllers\Mix\Admin\PermissionController;
use App\Http\Controllers\Mix\Admin\ProfileController;
use App\Http\Controllers\Mix\Admin\RegionController;
use App\Http\Controllers\Mix\Admin\CityController;
use App\Http\Controllers\Mix\Admin\RoleController;
use App\Http\Controllers\Mix\Admin\SettingController;
use App\Http\Middleware\PreventAccessFromTenantDomains;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ForceSSL;

Route::group(['middleware' => [ForceSSL::class]], function () {
    Route::any('previewComponent/{id}', [ComponentController::class, 'previewComponent'])->name('previewComponent');
    Route::any('previewDefaultThemePage', [DefaultThemePageController::class, 'previewDefaultThemePage'])->name('previewDefaultThemePage');
    Route::any('previewDefaultFullThemePage/{id}', [DefaultThemePageController::class, 'previewDefaultFullThemePage'])->name('previewDefaultFullThemePage');
    Route::any('previewDefaultTheme', [DefaultThemeController::class, 'previewDefaultTheme'])->name('previewDefaultTheme');

    Route::middleware([PreventAccessFromTenantDomains::class])->group(function () {
        Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
            Auth::routes();
            Route::group(['middleware' => ['auth', 'role:Admin|Owner']], function () {
                Route::get('/', [HomeController::class, 'index'])->name('home');
                Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
                Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::any('website/statistics/{Tenant}', [TenantsController::class, 'statistics'])->name('website.statistics');
                Route::any('clients/acceptTenant', [ClientsController::class, 'acceptTenant'])->name('clients.acceptTenant');
                Route::resources([
                    'admins' => AdminsController::class,
                    'agents' => AgentsController::class,
                    'clients' => ClientsController::class,
                    'roles' => RoleController::class,
                    'permissions' => PermissionController::class,
                    'faq' => FAQController::class,
                    'contact' => ContactController::class,
                    'settings' => SettingController::class,
                    'payments' => PaymentsController::class,
                    'type.images' => ImagesController::class,
                    'imagetypes' => ImageTypeController::class,
                    'blogs' => BlogController::class,
                    'stores' => StoresController::class,
                    'countries' => CountryController::class,
                    'country.regions' => RegionController::class,
                    'country.region.cities' => CityController::class,
    
                    'components' => ComponentController::class,
                    'websites' => TenantsController::class,
                    'features' => FeatureController::class,
                    'feature_headers' => FeatureHeaderController::class,
                    'packages' => PackageController::class,
                    'package_descs' => PackageDescController::class,
                    'default_theme_pages' => DefaultThemePageController::class,
                    'default_themes' => DefaultThemeController::class,
                    'send_mail' => MailController::class,
                    'deliveries' => DeliveryController::class,
                ]);
                Route::any('/blogs/uploadImages', [BlogController::class, 'uploadImages'])->name('blogs.uploadImages');
            });
    
            Route::any('fullDefaultTheme/{id}', [DefaultThemeController::class, 'fullDefaultTheme'])->name('fullDefaultTheme'); //for theme pages of a theme
            Route::get('reports', [ReportController::class,'reports'])->name('reports');
            Route::get('reports/sales', [ReportController::class,'sales'])->name('reports.sales');
            Route::get('reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
            Route::get('reports/client', [ReportController::class, 'client'])->name('reports.client');
            Route::get('reports/payment', [ReportController::class, 'payment'])->name('reports.payment');
            Route::get('reports/mostselling', [ReportController::class, 'mostselling'])->name('reports.mostselling');
            Route::get('reports/vat', [ReportController::class, 'vat'])->name('reports.vat');
            Route::get('reports/products', [ReportController::class, 'test']);
            Route::Get('exportData', [ReportController::class, 'exportData'])->name('exportData');
        });
        
    });
});
