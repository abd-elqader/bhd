<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\Pagination;
use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\ProductResource;
use App\Models\Tenant\Product;
use App\Models\Tenant\ProductSizeColor;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function store($lang, Request $request)
    {
        $query = Product::query()
            ->with(['SizeColor' => ['Color', 'Size'], 'Rates.Client', 'Categories'])
            ->whereHas('SizeColor', function ($q) use ($request) {
                $q->with(['Color', 'Size']);
                if ($request->color_id) {
                    $q->where('color_id', $request->color_id);
                }
                if ($request->size_id) {
                    $q->where('size_id', $request->size_id);
                }
            })->WhereHas('Categories', function ($q) use ($request) {
                $request->category_id ? $q->where('category_id', $request->category_id) : '';
            })
            ->when($request->title, function ($query) use ($request) {
                return $query->where('title_ar', 'like', '%'.$request->title.'%')->orwhere('title_en', 'like', '%'.$request->title.'%');
            })->Active();
        if ($request->filter) {
            if ($request->filter == 'sale') {
                $query = $query->whereHas('SaleProducts')->withCount(['SaleProducts'])->orderBy('sale_products_count');
            }
            if ($request->filter == 'most') {
                $query = $query->withCount(['OrdersProducts'])->with('SizeColor')->orderBy('orders_products_count');
            }
            if ($request->filter == 'latest') {
                $query = $query->orderBy('created_at', 'desc');
            }
            if ($request->filter == 'popular') {
                $query = $query->whereHas('FavProducts')->withCount(['FavProducts'])->orderBy('fav_products_count');
            }
            if ($request->filter == 'high_price') {
               $ids = [];
                foreach (ProductSizeColor::orderBy('price', 'desc')->select('product_id')->get() as $item) {
                    array_push($ids, $item->product_id);
                }
                $query = $query->orderByRaw('FIELD(id,'.implode(',', $ids).')');
            }
            if ($request->filter == 'low_price') {
               $ids = [];
                foreach (ProductSizeColor::orderBy('price', 'asc')->select('product_id')->get() as $item) {
                    array_push($ids, $item->product_id);
                }
                $query = $query->orderByRaw('FIELD(id,'.implode(',', $ids).')');
            }
        }
        $Products = $query->paginate( $request->increment ?? 10 );
        $this->CheckCount($Products);
        $Products->data = ProductResource::collection($Products);
        return ResponseHelper::make($Products);
    }

    public function show($lang, $id, Request $request)
    {
        $Product = Product::where('id', $id)->with(['SizeColor' => ['Color', 'Size'], 'Rates.Client', 'Categories'])->Active()->first();
        $similar = Product::where('id', '!=', $Product->id)->With(['SizeColor' => ['Color', 'Size'], 'Rates.Client', 'Categories' => function ($q) use ($Product) {
            $q->whereIn('category_id', $Product->Categories->pluck('id')->toarray());
        }, ])->Active()->take(6)->get();
        $this->CheckExist($Product);

        return ResponseHelper::make([
            'product' => ProductResource::make($Product),
            'similar' => ProductResource::collection($similar),
        ]);
    }
}
