<?php

namespace App\Helper;

use App\Models\Tenant\Product;
use Illuminate\Support\Facades\Session;

class Cart
{
    public static function store($Product_id, $quantity, $color_id = null, $size_id = null, $additions = [])
    {
        $Product = Product::with('SizeColor')->findorfail($Product_id);

        $SizeColor = $Product->SizeColor->where('color_id', $color_id)->where('size_id', $size_id)->first();

        $exist = false;
        $cart = Session::get('cart');

        if (! $SizeColor || $quantity < 1 || $SizeColor->quantity < $quantity) {
            alert()->error(__('website.quantityNotenough'));
        }

        if (! empty($cart)) {
            foreach ($cart as $key => $pro) {
                if ($pro['product_id'] == $Product_id && $pro['color_id'] == $color_id && $pro['size_id'] == $size_id) {
                    $exist = true;
                    if (($cart[$key]['quantity'] + $quantity) < $SizeColor->quantity) {
                        $cart[$key]['product_id'] = (int) $Product_id;
                        $cart[$key]['color_id'] = (int) $color_id;
                        $cart[$key]['size_id'] = (int) $size_id;
                        $cart[$key]['quantity'] = (int) ($cart[$key]['quantity'] + $quantity);
                        $cart[$key]['additions'] = (array) $additions;
                        Session::put('cart', $cart);
                    } else {
                        alert()->error(__('website.quantityNotenough'));
                    }
                }
            }

            if (! $exist) {
                Session::push('cart', [
                    'product_id' => (int) $Product_id,
                    'quantity' => (int) $quantity,
                    'color_id' => (int) $color_id,
                    'size_id' => (int) $size_id,
                    'additions' => (array) $additions,
                ]);
            }
        } else {
            Session::push('cart', [
                'product_id' => (int) $Product_id,
                'size_id' => (int) $size_id,
                'color_id' => (int) $color_id,
                'quantity' => (int) $quantity,
                'additions' => (array) $additions,
            ]);
        }

        // alert()->success(__('messages.addedSuccessfully'));
    }

    public static function destroy($cart_id)
    {
        $cart = Session::get('cart');
        unset($cart[$cart_id]);
        Session::put('cart', $cart);
        Session::save();
        alert()->success(__('messages.DeletedSuccessfully'));
    }

    public static function cartPlus($Product_id, $color_id = null, $size_id = null)
    {
        $quantity = 1;
        $Product = Product::with('SizeColor')->findorfail($Product_id);

        $SizeColor = $Product->SizeColor->where('color_id', $color_id)->where('size_id', $size_id)->first();

        $cart = Session::get('cart');

        foreach ($cart as $key => $item) {
            if ($SizeColor->quantity >= $item['quantity'] + $quantity) {
                if ($Product_id == $item['product_id'] && $color_id == $item['color_id'] && $size_id == $item['size_id']) {
                    $cart[$key]['quantity'] += $quantity;
                }
                Session::put('cart', $cart);
            }
        }
    }

    public static function cartMinus($Product_id, $color_id = null, $size_id = null)
    {
        $quantity = 1;
        $cart = Session::get('cart');
        foreach ($cart as $key => $item) {
            if ($quantity >= 1 && $item['quantity'] > 1) {
                if ($Product_id == $item['product_id'] && $color_id == $item['color_id'] && $size_id == $item['size_id']) {
                    $cart[$key]['quantity'] -= $quantity;
                }
                Session::put('cart', $cart);
            }
        }
    }
}
