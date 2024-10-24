<?php

declare(strict_types=1);

use App\Http\Controllers\Mix\Admin\{
    AdminsController,
    AgentsController,
    ContactController,
    CountryController,
    FAQController,
    ImagesController,
    ImageTypeController,
    NavbarController,
    PaymentsController,
    PermissionController,
    ProfileController,
    RegionController,
    CityController,
    RoleController,
    SettingController
};

use App\Http\Controllers\Tenant\Admin\{
    AdditionsController,
    AddressController,
    BranchController,
    CartController,
    CategoryController,
    ClientsController,
    ColorController,
    CouponController,
    CurrancyController,
    DelivryController,
    HomeController,
    OfferController,
    OfferTypeController,
    OrderController,
    ProductController,
    RemovesController,
    ReportController,
    SizeController,
    MobileController,
    // WeightController,
    PackageController,
    DeliveryController
};

use App\Http\Middleware\checkAdminTenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([InitializeTenancyByDomain::class, PreventAccessFromCentralDomains::class])->group(function () {


    Route::group(['prefix' => 'dashboard', 'as' => 'admin.'], function () {
        Route::any('login_wihout_form', [\App\Http\Controllers\Mix\Auth\LoginController::class, 'login_wihout_form'])->name('login_wihout_form');
        Auth::routes();
        Route::group(['middleware' => [checkAdminTenant::class, 'role:Admin|Owner']], function () {
            Route::any('/', [HomeController::class, 'index'])->name('home');
            Route::any('profile', [ProfileController::class, 'show'])->name('profile.show');
            Route::any('profile', [ProfileController::class, 'update'])->name('profile.update');

            Route::any('products/import',[ProductController::class,'import'])->name('products.import');
            Route::POST('products/{product_id}/image/{image_id}/switch', [ProductController::class, 'switchProductMainImage'])->name('ProductMainImage.switch');
            Route::POST('products/{product_id}/size/{size_id}/switch', [ProductController::class, 'switchProductSize'])->name('productSize.switch');
            Route::GET('products/{product_id}/size/{size_id}', [ProductController::class, 'editSizeColorDetails'])->name('editSizeColorDetails');
            Route::PUT('products/{product_id}/size/{size_id}', [ProductController::class, 'updateSizeColorDetails'])->name('updateSizeColorDetails');
            Route::GET('products/{product_id}/images/{color_id}', [ProductController::class, 'editColorImageDetails'])->name('editColorImageDetails');
            Route::PUT('products/{product_id}/images/{color_id}', [ProductController::class, 'updateColorImageDetails'])->name('updateColorImageDetails');

            Route::any('/orders/last_order_id', [OrderController::class, 'last_order_id'])->name('orders.last_order_id');
            Route::any('/orderStatus', [OrderController::class, 'changeStatus'])->name('orderStatus');
            Route::any('/orders/{method?}', [OrderController::class, 'index'])->name('orders');
            Route::any('/settings/{type?}', [SettingController::class, 'index'])->name('settings');
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
                'countries' => CountryController::class,
                'country.regions' => RegionController::class,
                'country.region.cities' => CityController::class,

                'branches' => BranchController::class,
                'categories' => CategoryController::class,
                'products' => ProductController::class,
                'sizes' => SizeController::class,
                'colors' => ColorController::class,
                'additions' => AdditionsController::class,
                'removes' => RemovesController::class,
                'deliveries' => DelivryController::class,
                // 'weights' => WeightController::class,
                'carts' => CartController::class,
                'currencies' => CurrancyController::class,
                'coupons' => CouponController::class,
                'offertypes' => OfferTypeController::class,
                'offers' => OfferController::class,
                'orders' => OrderController::class,
                'addresses' => AddressController::class,
                'packages' => PackageController::class,
                'delivery/company' => DeliveryController::class,
            ]);


            Route::get('mobile-app', [MobileController::class, 'index'])->name('mobile-app.index');


            Route::get('reports/sales', [ReportController::class,'sales'])->name('reports.sales');
            Route::get('reports/financial', [ReportController::class, 'financial'])->name('reports.financial');
            Route::get('reports/client', [ReportController::class, 'client'])->name('reports.client');
            Route::get('reports/payment', [ReportController::class, 'payment'])->name('reports.payment');
            Route::get('reports/mostselling', [ReportController::class, 'mostselling'])->name('reports.mostselling');
            Route::get('reports/abandoned_carts', [ReportController::class, 'abandoned_carts'])->name('reports.abandoned_carts');
            Route::get('reports/vat', [ReportController::class, 'vat'])->name('reports.vat');
            Route::get('reports/products', [ReportController::class, 'test']);
            Route::Get('exportData', [ReportController::class, 'exportData'])->name('exportData');
        });
    });
});
