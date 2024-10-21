<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\CategoryResource;
use App\Http\Resources\Tenant\ImageResource;
use App\Http\Resources\Tenant\ProductResource;
use App\Http\Resources\Tenant\SliderResource;
use App\Models\Image;
use App\Models\Tenant\Category;
use App\Models\Tenant\Product;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index($lang, Request $request)
    {
        $data = [];
        foreach(custum_mobile()->mobile_home as $key =>  $custum_mobile_item){
            if($custum_mobile_item == 'slider'){
                $data[$custum_mobile_item] = SliderResource::collection(Images()->where('type_id', 1));
            }elseif($custum_mobile_item == 'slider'){
                $data[$custum_mobile_item] = ImageResource::collection(Images()->where('type_id', 2));
            }elseif($custum_mobile_item == 'banner'){
                $data[$custum_mobile_item] = ImageResource::collection(Images()->where('type_id', 3));
            }elseif($custum_mobile_item == 'testimonials'){
                $data[$custum_mobile_item] = ImageResource::collection(Images()->where('type_id', 4));
            }elseif($custum_mobile_item == 'features'){
                $data[$custum_mobile_item] = ImageResource::collection(Images()->where('type_id', 5));
            }elseif($custum_mobile_item == 'grid_images'){
                $data[$custum_mobile_item] = ImageResource::collection(Images()->where('type_id', 6));
            }elseif($custum_mobile_item == 'most_selling'){
                $data[$custum_mobile_item] = ProductResource::collection(Product::where('most_selling', 1)->Active()->take(12)->get());
            }elseif($custum_mobile_item == 'popular'){
                $data[$custum_mobile_item] = ProductResource::collection(Product::where('popular', 1)->Active()->take(12)->get());
            }elseif($custum_mobile_item == 'sale' || $custum_mobile_item == 'offers'){
                $data[$custum_mobile_item] = ProductResource::collection(Product::whereHas('SaleProducts')->withCount(['SaleProducts'])->with('SizeColor')->orderBy('sale_products_count')->Active()->take(12)->get());
            }elseif($custum_mobile_item == 'newest'){
                $data[$custum_mobile_item] = ProductResource::collection(Product::orderByDESC('created_at')->Active()->take(12)->get());
            }elseif($custum_mobile_item == 'categories'){
                $data[$custum_mobile_item] = CategoryResource::collection(Category::Active()->get());
            }elseif($custum_mobile_item == 'animated_products'){
                $data[$custum_mobile_item] = ProductResource::collection(Product::orderByDESC('created_at')->Active()->take(12)->get());
            }elseif($custum_mobile_item == 'static_products'){
                $data[$custum_mobile_item] = ProductResource::collection(Product::orderByDESC('created_at')->Active()->take(12)->get());
            }
        }
        
        if(empty($data)){
            $data = (object) $data;
        }
        
        return ResponseHelper::make($data);
    }
}
