<?php

namespace App\Http\Controllers\Tenant\User;

use App\Helper\Cart;
use App\Http\Controllers\Controller;
use App\Models\Tenant\ProductSizeColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        Cart::store($request->product_id, $request->quantity, $request->color_id, $request->size_id);
        alert()->success(__('messages.addedSuccessfully'));
        return back();
    }

    public function CartPlus(Request $request)
    {
        Cart::cartPlus((int) $request->product, (int) $request->color, (int) $request->size, (int) $request->weight);
    }

    public function CartMinus(Request $request)
    {
        Cart::cartMinus((int) $request->product, (int) $request->color, (int) $request->size, (int) $request->weight);
    }

    public function cartDestroy(Request $request)
    {
        Cart::destroy($request->id);

        return ['cart' => count(session()->get('cart'))];
    }

    public function sizeColorFilter(Request $request)
    {
        if ($request->type == 'getSizes') {
            $items = ProductSizeColor::where('product_id', $request->id)->where('color_id', $request->color_id)->with('Size')->get();
            $data = [];
            $i = 1;
            $data[0] = '<option value="" selected hidden></option>';
            foreach ($items->unique('size_id') as $key => $item) {
                $data[$i] = '<div class="col-4 px-0 mx-1 point" >
                                <h5 style="margin:auto; font-size:12px; border: 1px solid black; border-radius:25px;" class="sizeItem p-2" data-id="'.$item->size->id.'">'.$item->size->title().'</h5>
                            </div>';
                $i++;
            }

            return ['data' => $data];
        } elseif ($request->type == 'getWeight') {
            $items = ProductSizeColor::where('product_id', $request->id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->with('Weight')->get();
            if ($items->count() <= 1) {
                $item = ProductSizeColor::where('product_id', $request->id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->with('Weight')->first();
                if ($item->Weight) {
                    return ['count' => 'one', 'data' => $item->Weight->id, 'quantity' => $item->quantity, 'price' => $item->price];
                } else {
                    return ['count' => 'one', 'data' => 0, 'quantity' => $item->quantity, 'price' => $item->price];
                }
            } else {
                $data = [];
                $i = 1;
                $data[0] = '<option value="" selected hidden></option>';
                return ['count' => 'else', 'data' => $data];
            }
        } elseif ($request->type == 'getQuantity') {
            $item = ProductSizeColor::where('product_id', $request->id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();

            return ['quantity' => $item->quantity, 'price' => $item->price];
        }
    }
}
