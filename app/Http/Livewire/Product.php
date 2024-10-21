<?php

namespace App\Http\Livewire;

use App\Models\Tenant\Product as ModelsProduct;
use App\Models\Tenant\ProductFavourite;
use App\Models\Tenant\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Product extends Component
{
    public $similar;

    public $product_page_num;

    public $Product;
    
    public $main_image;

    public $quantity;

    public $SizeColor;

    public $SelectedSize;

    public $SelectedColor;

    public $SelectedSizeColor;

    public function mount($product_id, $product_page_num)
    {
        $this->product_page_num = $product_page_num;
        $this->quantity = 1;
        $this->Product = ModelsProduct::where('id', $product_id)->with(['Categories', 'Images', 'SizeColor' => ['Size', 'Color'], 'Rates'])->first();
        $this->Product->rate = $this->Product->rate();
        $this->SizeColor = $this->Product->SizeColor;
        $this->SelectedSizeColor = $this->SizeColor->first();
        $this->SelectedSize = $this->SelectedSizeColor?->size_id;
        $this->SelectedColor = $this->SelectedSizeColor?->color_id;

        $this->similar = ModelsProduct::Active()->whereNot('id', $this->Product->id)->with(['SizeColor' => ['Color', 'Size']])->WhereHas('Categories', function ($query) {
            $query->whereIn('category_id', $this->Product->categories->pluck('id'));
        })->take(18)->get();
        $this->main_image =  public_asset($this->Product->RandomImage());
    }

    public function render()
    {
        return view('Tenant.User.components.Product.product');
    }
    
    public function set_main_image($val)
    {
        $this->main_image = $val;
    }

    public function updatedSelectedSize($value)
    {
        $this->quantity = 1;
        $this->SelectedSizeColor = $this->SizeColor->where('size_id', $value)->first();
        $this->SelectedColor = $this->SelectedSizeColor?->color_id;
    }

    public function updatedSelectedColor($value)
    {
        $this->quantity = 1;
        $this->SelectedSizeColor = $this->SizeColor->where('size_id', $this->SelectedSize)->where('color_id', $value)->first();
    }

    public function qtyminus()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function qtyPlus()
    {
        if ($this->SelectedSizeColor?->quantity > $this->quantity && $this->SelectedSizeColor?->status == 1) {
            $this->quantity++;
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('website.quantityNotenough')]);
        }
    }

    public function AddToCart()
    {
        $Product_id = $this->Product->id;
        $color_id = $this->SelectedColor;
        $size_id = $this->SelectedSize;
        $quantity = $this->quantity;
        $note = null;

        $Product = ModelsProduct::with('SizeColor')->findorfail($Product_id);
        $SizeColor = $Product->SizeColor;
        if ($color_id) {
            $SizeColor = $SizeColor->where('color_id', $color_id);
        }
        if ($size_id) {
            $SizeColor = $SizeColor->where('size_id', $size_id);
        }
        $SizeColor = $SizeColor->first();

        if (! $SizeColor) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('website.quantityNotenough')]);
        } else {
            Cart::updateOrCreate(
                [
                    'client_id' => client_id(),
                    'product_id' => $Product_id,
                    'color_id' => $color_id,
                    'size_id' => $size_id,
                ],
                [
                    'client_id' => client_id(),
                    'product_id' => $Product_id,
                    'color_id' => $color_id,
                    'size_id' => $size_id,
                    'quantity' => $quantity,
                    'note' => $note,
                ]
            );
            $this->dispatchBrowserEvent('RefreshCartModal', ['count' => Cart::where('client_id',client_id())->count()]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('messages.addedSuccessfully')]);
        }
    }

    public function ToggleLikeProduct()
    {
        if(auth('client')->check()){
            if(ProductFavourite::where('client_id', auth('client')->id())->where('product_id', $this->Product->id)->count() > 0){
                ProductFavourite::where('client_id', auth('client')->id())->where('product_id', $this->Product->id)->delete();
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('messages.DeletedSuccessfully')]);
            }else{
                ProductFavourite::create(['client_id' => auth('client')->id(), 'product_id' => $this->Product->id]);
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('website.addToFav')]);
            }
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('website.needLogin')]);
        }
    }
}
