<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Requests\Tenant\API\CartRequest;
use App\Http\Requests\Tenant\API\GetCartRequest;
use App\Http\Resources\Tenant\CartResource;
use App\Models\Tenant\Cart;
use App\Models\Payment;
use App\Models\Tenant\Product;
use App\Models\Tenant\Address;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function index($lang, GetCartRequest $request)
    {
        $CartQuery = Cart::where('client_id', auth('sanctum')->id())->get();
        $this->CheckCount($CartQuery);
        $weight = 0.000;
        $subTotal = 0.000;
        $discount = 0.000;
        $total_after_discount = 0.000;
        foreach ($CartQuery as $CartItem) {
            $subTotal += $CartItem->total_after_discount;
            $weight += $CartItem->Product->weight *  $CartItem['quantity'];
            
        }
        $Cart['subTotal_value'] = number_format($subTotal, DefaultCurrancy()->decimals, '.', '');
        $Cart['subTotal'] = number_format($subTotal, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;

        $Setting_Dicount = setting('discount');
        $Setting_VAT = setting('VAT') ?? 0.000;
        
        $Setting_delivery_cost = 0.000;
        
        if($request->address_id){  
            $Address = Address::where('id', $request->address_id)->first();
            if($Address){    
                $Branches = [];
                foreach(Branches() as $Branch){
                    $Branches[] = [
                        'distance' => distance($Address->lat,$Address->long,$Branch->lat,$Branch->long),
                        'branch' => $Branch,
                    ];
                }
                $ShortBranch = collect($Branches)->sortBy('distance')->first();
                $Branch = $ShortBranch['branch'];
                
                $Setting_delivery_cost = delivery_cost($Address->lat,$Address->long,$Branch->lat,$Branch->long,$request->same_day_price,$ShortBranch['distance'],DefaultCurrancy()->id,$weight);
            }
        }
         
             
        $delivery_cost_value = $Setting_delivery_cost;

        $Cart['discount'] = $Setting_Dicount > 0 ? true : false;
        $Cart['discount_percentage'] = $Setting_Dicount ? $Setting_Dicount.' %' : null;
        $discount_value = number_format($subTotal * $Setting_Dicount / 100, DefaultCurrancy()->decimals, '.', '');
        $Cart['discount_value'] = $discount_value.' '.DefaultCurrancy()->currancy_code;

        $Cart['VAT'] = $Setting_VAT > 0 ? true : false;
        $Cart['VAT_percentage'] = $Setting_VAT ? $Setting_VAT.' %' : null;
        $VAT_value = number_format(($subTotal - $discount_value) * $Setting_VAT / 100, DefaultCurrancy()->decimals, '.', '');
        $Cart['VAT_value'] = $VAT_value.' '.DefaultCurrancy()->currancy_code;

        if ($request->delivery_id == 1) {
            $Cart['delivery_cost'] = $Setting_delivery_cost > 0 ? true : false;
            $delivery_cost_value = number_format($Setting_delivery_cost * DefaultCurrancy()->currancy_value, DefaultCurrancy()->decimals, '.', '');
            $Cart['delivery_cost_value'] = $delivery_cost_value.' '.DefaultCurrancy()->currancy_code;
        }
        $OnlineVat = 0;

        $netTotal = $subTotal + $VAT_value - $discount_value + $delivery_cost_value + $OnlineVat;
        if(setting('OnlineVat') && $request->payment_id > 1){
            if(!$request->country_id || $request->country_id == 1){
                $OnlineVat = ($netTotal / 100 * Payment::where('id',$request->payment_id)->first()->vat_local ); 
            }else{
                $OnlineVat = ($netTotal / 100 * Payment::where('id',$request->country_id)->first()->vat_global ); 
            }
        }
        $Cart['OnlineVat_value'] = number_format($OnlineVat, DefaultCurrancy()->decimals, '.', '');
        $Cart['OnlineVat'] = number_format($OnlineVat, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        
        $netTotal += $OnlineVat;
        $Cart['netTotal_value'] = number_format($netTotal, DefaultCurrancy()->decimals, '.', '');
        $Cart['netTotal'] = number_format($netTotal, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;


        $Cart['data'] = CartResource::collection($CartQuery);

        return ResponseHelper::make($Cart);
    }

    public function store($lang, CartRequest $request)
    {
        $this->CheckAuth();
        $Product_id = $request->product_id;
        $color_id = $request->color_id;
        $size_id = $request->size_id;
        $note = $request->note;
        $quantity = $request->quantity ?? 1;

        $exist = false;
        $cart = Cart::where('client_id', auth('sanctum')->id())->get();
        $Product = Product::with('SizeColor')->find($Product_id);
        $SizeColor = $Product?->SizeColor
            ->when($size_id > 0, function ($q) use ($size_id) {
                return $q->where('size_id', $size_id);
            })
             ->when($color_id > 0, function ($q) use ($color_id) {
                 return $q->where('color_id', $color_id);
             })
            ->first();

        if (! $SizeColor || $quantity < 1 || $SizeColor->quantity < $quantity) {
            return ResponseHelper::make(null, __('messages.sorry_there_was_an_error'), true, 404);
        }

        if (! empty($cart)) {
            foreach ($cart as $key => $CartItem) {
                if ($CartItem['product_id'] == $Product_id && $CartItem['color_id'] == $color_id && $CartItem['size_id'] == $size_id) {
                    $exist = true;
                    if (($CartItem['quantity'] + $quantity) < $SizeColor->quantity) {
                        Cart::where('product_id', $Product_id)->where('size_id', $size_id)->when($color_id > 0, function ($q) use ($color_id) {
                            return $q->where('color_id', $color_id);
                        })->update([
                            'quantity' => (int) $quantity,
                        ]);

                        return ResponseHelper::make(null, __('messages.updatedSuccessfully'));
                    } else {
                        return ResponseHelper::make(null, __('website.quantityNotenough'), true, 404);
                    }
                }
            }
            if (! $exist) {
                Cart::create([
                    'client_id' => (int) auth('sanctum')->id(),
                    'product_id' => (int) $Product_id,
                    'quantity' => (int) $quantity,
                    'color_id' => (int) $color_id,
                    'size_id' => (int) $size_id,
                    'note' => (string) $note,
                ]);

                return ResponseHelper::make(null, __('messages.addedSuccessfully'));
            }
        } else {
            Cart::create([
                'client_id' => (int) auth('sanctum')->id(),
                'product_id' => (int) $Product_id,
                'size_id' => (int) $size_id,
                'color_id' => (int) $color_id,
                'quantity' => (int) $quantity,
                'note' => (string) $note,
            ]);

            return ResponseHelper::make(null, __('messages.addedSuccessfully'));
        }
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $Cart = Cart::query()
            ->where('id', $id)
            ->first();
        $this->CheckExist($Cart);

        return ResponseHelper::make(CartResource::make($Cart));
    }

    public function update($lang, $id, CartRequest $request)
    {
        $this->CheckAuth();
        $Cart = Cart::where('client_id', auth('sanctum')->id())->where('id', $id)->first();
        $this->CheckExist($Cart);
        $Cart->update($request->validated());

        return ResponseHelper::make(CartResource::make($Cart), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id, Request $request)
    {
        $this->CheckAuth();
        if ($request->all) {
            $Cart = Cart::where('client_id', auth('sanctum')->id())->delete();
        } else {
            $Cart = Cart::where('client_id', auth('sanctum')->id())->where('id', $id)->delete();
        }

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }

    public function check(Request $request)
    {
        $this->CheckAuth();
        $Cart = Cart::with('Product')->where('client_id', auth('sanctum')->id())->get();
        $this->CheckCount($Cart);

        return ResponseHelper::make(collect($this->CartCalculations($Cart, $request)));
    }
}
