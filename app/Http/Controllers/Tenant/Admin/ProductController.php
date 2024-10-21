<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\Upload;
use App\Imports\ImportProducts;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreProductRequest;
use App\Http\Requests\Tenant\Admin\UpdateProductRequest;
use App\Models\Tenant\Category;
use App\Models\Tenant\Color;
use App\Models\Tenant\Product;
use App\Models\Tenant\ProductCategory;
use App\Models\Tenant\ProductImage;
use App\Models\Tenant\ProductSizeColor;
use App\Models\Tenant\Size;
use App\Models\Tenant\Weight;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:products-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:products-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:products-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:products-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        // foreach(ProductImage::get() as $Model){
        //     $img = \Intervention\Image\Facades\Image::make(public_path($Model->image))->encode('webp')->fit(1024)->save(public_path($Model->image));
        // }
        // dd(1);

        if ($request->ajax()) {
            $Products = Product::with(['Images','Categories', 'SizeColor' => ['Size','Color']]);
            if ($request->category_id) {
                $Products = $Products->whereHas('Categories', function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                });
            }

            return DataTables::of($Products)
                ->addColumn('action', function ($Product) {
                    return '
                            <a href="' . route('admin.products.edit', $Product) . '"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="' . route('admin.products.destroy', $Product) . '">
                                ' . csrf_field() . '
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->addColumn('title', function ($Product) {
                    return $Product->title();
                })
                ->addColumn('category', function ($Product) {
                    $first = $Product->Categories->first();
                    $first_route =  $first ? route('admin.categories.show', $first->id) : '';
                    return '<a href="' . $first_route .'">'.$first?->title().'</a>';
                })
                ->addColumn('image', function ($Model) {
                    return '<a class="image-popup-no-margins" href="' . public_asset($Model->RandomImage()) . '">
                        <img src="' . public_asset($Model->RandomImage()) . '" style="max-height: 150px;max-width: 150px">
                    </a>';
                })
                ->editColumn('status', function ($Product) {
                    if ($Product->status) {
                        return '<label data-id="' . $Product->id . '" class="switch status_toggleswitch bg-dark"><input id="status_checkbox' . $Product->id . '" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="' . $Product->id . '" class="switch status_toggleswitch bg-dark"><input id="status_checkbox' . $Product->id . '" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('popular', function ($Product) {
                    if ($Product->popular) {
                        return '<label data-id="' . $Product->id . '" class="switch popular_toggleswitch bg-dark"><input id="popular_checkbox' . $Product->id . '" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="' . $Product->id . '" class="switch popular_toggleswitch bg-dark"><input id="popular_checkbox' . $Product->id . '" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('most_selling', function ($Product) {
                    if ($Product->most_selling) {
                        return '<label data-id="' . $Product->id . '" class="switch most_selling_toggleswitch bg-dark"><input id="most_selling_checkbox' . $Product->id . '" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="' . $Product->id . '" class="switch most_selling_toggleswitch bg-dark"><input id="most_selling_checkbox' . $Product->id . '" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('price', function ($Product) {
                    if($Product->SizeColor->unique('price')->count() > 1){
                        return $Product->SizeColor->unique('price')->min('price') .'-'. $Product->SizeColor->unique('price')->max('price').' '. MainCurrancy()->country_code;
                    }else{
                        return $Product->SizeColor->unique('price')->min('price') . ' '. MainCurrancy()->country_code;
                    }
                })
                ->editColumn('quantity', function ($Product) {
                    if($Product->SizeColor->unique('quantity')->count() > 1){
                        $text = '';
                        foreach($Product->SizeColor->unique('quantity') as $item){
                            $text .= $item?->quantity . ',';
                        }
                        return $text;
                    }else{
                        return $Product->SizeColor->first()?->quantity;
                    }
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->title && !is_null($request->title)) {
                        $instance->where('title_ar', 'LIKE', '%' . $request->title . '%')
                            ->orwhere('title_ar', 'LIKE', '%' . $request->title . '%');
                    }
                    if ($request->title_ar && !is_null($request->title_ar)) {
                        $instance->where('title_ar', 'LIKE', '%' . $request->title_ar . '%');
                    }
                    if ($request->title_en && !is_null($request->title_en)) {
                        $instance->where('title_en', 'LIKE', '%' . $request->title_en . '%');
                    }
                    if (!is_null($request->discount)) {
                        if (!$request->boolean('discount')) {
                            $instance->whereDoesntHave('Discount');
                        } elseif ($request->boolean('discount')) {
                            $instance->whereHas('Discount');
                        }
                    }
                    if (!is_null($request->category)) {
                        $instance->whereHas('Categories', function ($query) use ($request) {
                            $query->where('category_id', $request->category);
                        });
                    }

                    if ($request->price_from && !is_null($request->price_from)) {
                        $instance->whereHas('SizeColor', function ($query) use ($request) {
                            $query->where('price', '>=', $request->price_from);
                        });
                    }
                    if ($request->price_to && !is_null($request->price_to)) {
                        $instance->whereHas('SizeColor', function ($query) use ($request) {
                            $query->where('price', '<=', $request->price_to);
                        });
                    }

                    if ($request->time_from && !is_null($request->time_from)) {
                        $instance->where('created_at', '>=', $request->time_from);
                    }
                    if ($request->time_to && !is_null($request->time_to)) {
                        $instance->where('created_at', '<=', $request->time_to);
                    }
                    
                    if ($request->sort && !is_null($request->sort)) {
                        $ids = [];
                        foreach (ProductSizeColor::orderBy($request->sort_key, $request->sort)->select('product_id')->get() as $item)
                            array_push($ids, $item->product_id);
                        $instance->orderByRaw('FIELD(id,'.implode(',', $ids).')');
                    }else{
                        $instance->latest();
                    }
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="' . $Model->id . '">';
                })
                ->toJson();
        }
        $Categories = Category::get();

        return view('Tenant.Admin.products.index', compact('Categories'));
    }

    public function create()
    {
        $Categories = Category::get();
        $Sizes = Size::get();
        $Colors = Color::get();

        return view('Tenant.Admin.products.create', compact('Categories', 'Sizes', 'Colors'));
    }

    public function store(StoreProductRequest $request)
    {
        $Product = Product::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'code' => $request->code,
            'VAT' => $request->VAT,
            'weight' => $request->weight ?? 0,
            'most_selling' => $request->most_selling ? 1 : 0,
            'popular' => $request->popular ? 1 : 0,
            'status' => $request->status ? 1 : 0,
            'has_color' => count(array_filter((array)$request->colors)) ? 1 : 0,
            'has_size' => count(array_filter((array)$request->sizes)) ? 1 : 0,
        ]);

        if ($request->images)
            foreach ($request->images as $key => $img) {
                ProductImage::create([
                    'image' => Upload::UploadFile($img, 'products'),
                    'product_id' => $Product->id,
                ]);
            }
        if ($request->categories)
            foreach ($request->categories as $key => $cat) {
                ProductCategory::create([
                    'category_id' => $cat,
                    'product_id' => $Product->id,
                ]);
            }
            
        if($request->filter == 'has_size')
            ProductImage::where('product_id', $Product->id)->update(['color_id' => NULL]);

        ProductSizeColor::where('product_id', $Product->id)->delete();
        foreach ($request->prices as $key => $p) {
            ProductSizeColor::create([
                'product_id' => $Product->id,
                'size_id' => $request->sizes[$key],
                'color_id' => $request->colors[$key],
                'price' => $request->prices[$key],
                'quantity' => $request->quantities[$key],
                'discount' => $request->discount,
                'from' => $request->from,
                'to' => $request->to,
            ]);
        }

        alert()->success(__('messages.addedSuccessfully'));
        return redirect()->back();
    }

    public function show($id)
    {
        $Product = Product::where('id', $id)->with('Categories', 'Images', 'SizeColor')->first();
        return view('Tenant.Admin.products.show', compact('Product'));
    }


    public function edit($id)
    {
        foreach (ProductSizeColor::select('product_id', 'size_id', 'color_id', 'price', 'quantity')->groupBy('product_id', 'size_id', 'color_id', 'price', 'quantity')->havingRaw('count(*) > 1')->get() as $Dub) {
            ProductSizeColor::where('product_id', $Dub->product_id)->where('size_id', $Dub->size_id)->where('color_id', $Dub->color_id)->where('price', $Dub->price)->where('quantity', $Dub->quantity)->first()->delete();
        }

        $Product = Product::with('Categories', 'Images', 'SizeColor')->findorfail($id);
        $Categories = Category::get();
        $Sizes = Size::Active()->get();
        $Colors = Color::Active()->get();
        return view('Tenant.Admin.products.edit', compact('Categories', 'Sizes', 'Colors', 'Product'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $Product = Product::findorfail($id);
        $Product->update([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'desc_ar' => $request->desc_ar,
            'desc_en' => $request->desc_en,
            'code' => $request->code,
            'VAT' => $request->VAT,
            'weight' => $request->weight ?? 0,

            'most_selling' => $request->most_selling ? 1 : 0,
            'popular' => $request->popular ? 1 : 0,
            'status' => $request->status ? 1 : 0,
            
            'has_color' => in_array($request->filter, ['has_size_color','has_color']),
            'has_size' => in_array($request->filter, ['has_size_color','has_size']),
        ]);
        

        if ($request->categories)
            $Product->Categories()->sync($request->categories);
        
            
        $request['price'] =  $request['price'] ?? ProductSizeColor::where('price','>',0)->where('product_id', $Product->id)->first()?->price;
        $request['quantity'] =  $request['quantity'] ?? ProductSizeColor::where('quantity','>',0)->where('product_id', $Product->id)->first()?->quantity;
        
        
        if ($request->images)
            foreach ($request->images as $key => $img) {
                ProductImage::create([
                    'image' => Upload::UploadFile($img, 'products'),
                    'product_id' => $Product->id,
                ]);
            }
            
        if($request->filter == 'has_size')
            ProductImage::where('product_id', $Product->id)->update(['color_id' => NULL]);

        ProductSizeColor::where('product_id', $Product->id)->delete();
        foreach ($request->prices as $key => $p) {
            ProductSizeColor::create([
                'product_id' => $Product->id,
                'size_id' => $request->sizes[$key],
                'color_id' => $request->colors[$key],
                'price' => $request->prices[$key],
                'quantity' => $request->quantities[$key],
                'discount' => $request->discount,
                'from' => $request->from,
                'to' => $request->to,
            ]);
        }
            
      
        alert()->success(__('messages.updatedSuccessfully'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $Product = Product::where('id', $id)->first();
        $Product->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function editSizeColorDetails($product_id, $size_id, Request $request)
    {
        $product = Product::with(['images', 'SizeColor' => function ($q) use ($size_id) {
            $q->where('size_id', $size_id);
        }])->findOrFail($product_id);
        return view('Tenant.Admin.products.editSizeColorDetails', compact('product'));
    }

    public function updateSizeColorDetails($product_id, $size_id, Request $request)
    {
        $ProductColorSize = ProductSizeColor::where('product_id', $product_id)->where('size_id', $size_id);

        if ($request->price)
            $ProductColorSize->update(['price' => $request->price]);
        $ProductColorSize = $ProductColorSize->get();
        if ($ProductColorSize->count()) {
            foreach ($ProductColorSize as $key => $item) {
                if ($request->quantity && $request->quantity[$key])
                    $ProductColorSize->where('color_id', $item->color_id)->first()->update(['quantity' => $request->quantity[$key]]);
                else
                    ProductSizeColor::where('product_id', $product_id)->where('size_id', $size_id)->where('color_id', $item->color_id)->update(['quantity' => $request->size_quantity]);
            }
            if ($request->colors)
                foreach ($request->colors as $key => $color_id) {
                    if ($request->quantity[$key])
                        $ProductColorSize->where('color_id', $color_id)->first()->update(['status' => 1]);
                }
        }
        return redirect()->route('admin.products.edit', $product_id)->with('message', __('messages.productUpdatedSuccessfully'));
    }

    public function editColorImageDetails($product_id, $color_id, Request $request)
    {
        $Color = Color::find($color_id);
        $product = Product::with(['images' => function ($q) use ($color_id) {
            $q->where('color_id', $color_id)->orWhereNULL('color_id');
        }])->findOrFail($product_id);
        return view('Tenant.Admin.products.editColorImagesDetails', compact('product', 'Color'));
    }
    public function updateColorImageDetails($product_id, $color_id, Request $request)
    {
        if ($request->images) {
            ProductImage::where('product_id', $request->product_id)->where('color_id', $color_id)->update(['color_id' => null]);
            foreach ($request->images as $key => $item) {
                ProductImage::where('product_id', $request->product_id)->whereIn('id', $request->images)->update(['color_id' => $color_id]);
            }
        } else {
            ProductImage::where('product_id', $request->product_id)->where('color_id', $request->color_id)->update(['color_id' => null]);
        }
        if($request->quantity >= 0){
            ProductSizeColor::where('product_id', $request->product_id)->where('color_id', $color_id)->update(['quantity' => $request->quantity]);
        }
        if($request->price >= 0){
            ProductSizeColor::where('product_id', $request->product_id)->where('color_id', $color_id)->update(['price' => $request->price]);
        }
        return redirect()->route('admin.products.edit', $product_id)->with('message', __('messages.productUpdatedSuccessfully'));
    }


    public function switchProductSize($product_id, $size_id, Request $request)
    {
        $success = ProductSizeColor::where('product_id', $product_id)->where('size_id', $size_id)->update(['status' => $request->status ?? 0]);
        return response()->json($success);
    }
    
    public function switchProductMainImage($product_id, $image_id, Request $request)
    {
        $success = ProductImage::where('product_id', $product_id)->update(['main' => 0]);
        $success = ProductImage::where('product_id', $product_id)->where('id', $image_id)->update(['main' => 1]);
        return response()->json($success);
    }
    
    public function import(Request $request)
    {
        Excel::import(new ImportProducts,$request->file('file'));
        alert()->success(__('messages.addedSuccessfully'));
        return redirect()->back();
    }
 
}