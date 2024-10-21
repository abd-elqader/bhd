<?php

use App\Models\Central\DefaultTheme;
use App\Models\Tenant\Category;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Delivry;
use App\Models\Tenant\Offer;
use App\Models\Tenant\Product;
use App\Models\Central\PackageUser;
use App\Models\Theme;




function distance($lat1, $lon1, $lat2, $lon2)
{
    // $apiKey = env('MAP_KEY');
    // $client = new \GuzzleHttp\Client();
    // $response = $client->get("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$lat1,$lon1&destinations=$lat2,$lon2&key=$apiKey");
    // $data = json_decode($response->getBody());

    // if(isset($data->rows[0]->elements[0]->distance)){
    //     return $data->rows[0]->elements[0]->distance->value / 1000; //km
    // }else{
    //     return 9999999999999;
    // }


    $earthRadius = 6371;
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);
    $deltaLat = $lat2 - $lat1;
    $deltaLon = $lon2 - $lon1;
    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earthRadius * $c;
    return $distance;
}


// id Mapping:
// 1 -> Parcel
// 2 -> UBEX
// 3 -> ISCO
// 4 -> SMSA
// 6 -> Share Me
// 7 -> Delybell
function delivery_cost($lat1 = null, $lon1 = null, $lat2 = null, $lon2 = null, $distance = 0, $country_id = 1, $kg = 1)
{
    $delivery_cost = 0;

    if ($country_id == 1) {
        $Delivery = tenant()->DeliveryIn()->first();
        if ($Delivery == NULL && tenant()->delivry_id_in == 0) {
            return number_format(tenant()->charge_cost_in * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
        }
    } else {
        $Delivery = tenant()->DeliveryOut()->first();
        if ($Delivery == NULL && tenant()->charge_cost_out > 0) {
            return number_format(tenant()->charge_cost_out * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
        }
        if ($Delivery) {
            if ($Delivery->id == 2 || $Delivery->id == 7) {
                $delivery_weight = DB::connection('mysql')->table('delivery_weight')->where('delivery_id', $Delivery->id)->where('country_id', $country_id)->where('weight', '>=', $kg)->orderBy('weight')->first();
                if ($delivery_weight) {
                    $delivery_cost = $delivery_weight->price;
                } else {
                    $delivery_weight = DB::connection('mysql')->table('delivery_weight')->where('delivery_id', $Delivery->id)->where('country_id', $country_id)->orderByDesc('weight')->first();
                    if ($delivery_weight) {
                        $delivery_cost = $delivery_weight->price;
                    }
                }
            }
        }
    }
    return number_format($delivery_cost * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals);
}





function PackageDetails()
{
    if (!Config::get('PackageDetails')) {
        Config::set('PackageDetails', PackageUser::where('paid', 1)->latest()->with('Package')->where('client_id', tenant()->client_id)->where('paid', 1)->first());
    }
    return Config::get('PackageDetails');
}
function Categories($num = 8)
{
    if (!Config::get('Categories')) {
        Config::set('Categories', Category::latest()->Active()->get());
    }

    return Config::get('Categories')->take($num);
}
function allCategories()
{
    return Category::latest()->Active()->get();
}
function CategoriesWithProducts($CategoriesNum = 8, $ProductsNum = 8)
{
    return Category::latest()->Active()->WhereHas('Products', function ($q) use ($ProductsNum) {
        $q->take($ProductsNum);
    })->take($CategoriesNum)->get();
}
function Category($id, $num = 9)
{
    return Category::latest()->Active()->where('id', $id)->with([
        'Products' => function ($q) use ($num) {
            $q->paginate($num);
        }
    ])->first();
}
function Products($num = 9, $type = null, $category_ids = [])
{
    return Product::latest()->Active()
        ->with(['Images', 'SizeColor' => ['color', 'size']])
        ->when($type == 'offers', function ($query, $role) {
            return $query->whereHas('SizeColor', function ($q) {
                $q->where('discount', '>', 0)->where('from', '<=', now())->where('to', '>=', now());
            });
        })
        ->when(count($category_ids), function ($query) use ($category_ids) {
            return $query->whereHas('Categories', function ($q) use ($category_ids) {
                $q->whereIn('category_id', $category_ids);
            });
        })
        ->when($type == 'most_selling', function ($query, $role) {
            return $query->where('most_selling', 1);
        })
        ->when($type == 'popular', function ($query, $role) {
            return $query->where('popular', 1);
        })
        ->take($num)
        ->get();
}

function Delivries()
{
    if (!Config::get('Delivries')) {
        Config::set('Delivries', Delivry::Active()->get());
    }
    return Config::get('Delivries');
}

function Branches()
{
    if (!Config::get('Branches')) {
        Config::set('Branches', Branch::Active()->get());
    }
    return Config::get('Branches');
}

function theme($page_name)
{
    $theme_id = Settings()->where('type', 'theme')->value('value');
    $id = intval(substr($theme_id, strpos($theme_id, '-') + 1));
    if (!Config::get('theme'))
        Config::set('theme', DefaultTheme::where('id', $id)->first());

    foreach (Config::get('theme')->defaultThemePages as $key => $page) {
        foreach ($page->components->sortBy('pivot.row_id') as $component) {
            $theme[$page->type][$component->type] = $component->link;
        }
    }
    return $theme[$page_name] ?? collect();
}

function custum_mobile()
{
    if (!Config::get('custum_mobile'))
        Config::set('custum_mobile', DB::table('mobile')->first());
    $mobile = Config::get('custum_mobile');
    $mobile->color = setting('color');
    $mobile->mobile_home = collect(json_decode($mobile->mobile_home, true));
    foreach ($mobile->mobile_home->where('display', 1) as $key => $mobile_home_item) {
        $mobile->mobile_home[$key] = $mobile_home_item['key'];
    }
    $mobile->mobile_home = $mobile->mobile_home->values();
    return $mobile;
}


function client_id()
{
    if (auth('client')->check()) {
        return auth('client')->id();
    } else {
        if (! session()->get('client_id')) {
            session()->put('client_id', rand(99999, 999999));
        }

        return session()->get('client_id');
    }
}

