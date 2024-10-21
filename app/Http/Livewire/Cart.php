<?php

namespace App\Http\Livewire;

use App\Helper\ResponseHelper;
use App\Helper\WhatsApp;
use App\Mail\OrderSummary;
use App\Models\Client;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Region;
use App\Models\City;
use App\Models\Tenant\Cart as CartModel;
use App\Models\Setting;
use App\Models\Tenant\Address;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Coupon;
use App\Models\Tenant\Delivry;
use App\Models\Block;
use App\Models\Tenant\Order;
use App\Models\Tenant\Product;
use App\Models\Tenant\ProductSizeColor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Config;

class Cart extends Component
{
    public $NetTotal = 0;

    public $SubTotal = 0;
    
    public $vat_total = 0;

    public $Vat = 0;

    public $VAT_percentage = 0;

    public $Discount = 0;

    public $discount_percentage = 0;

    public $coupon = 0;

    public $coupon_percentage = 0;

    public $delivery_cost = 0;

    public $Cart;

    public $Products;

    public $AllCountries;

    public $AllRegions;
    
    public $AllCities;

    public $delivry_method;
    
    public $delivries;

    public $payment;

    public $payments;

    public $branch;

    public $branches;

    public $address;

    public $addresses;

    public $currentStep = 1;

    public $totalSteps = 3;

    public $code;

    public $name;

    public $phone;

    public $phone_length = 0;

    public $email;

    public $SelectedCountry;

    public $region_id;
    
    public $city_id;

    public $block;

    public $road;

    public $floor_no;

    public $building_no;

    public $apartment;

    public $type;

    public $additional_directions;
    
    public $latitude;
    
    public $longitude;

    public $terms;
    
    public $distance;
    
    public $weight;
    
    public $note;
    
    public $cart;

    public function mount()
    {
        $this->cart = CartModel::where('client_id',client_id())->get();
        if ($this->cart->count()) {
            $this->Products = Product::with(['SizeColor' => ['Size', 'Color']])->whereIn('id', $this->cart->pluck('product_id'))->get();
            $this->AllCountries = Country::Active()->get();
            $this->delivries = Delivry::Active()->get();

            
            $this->branches = Branch::Active()->get();

            if($this->delivries->count()){
                $this->delivry_method = $this->delivries->first()->id;
            }
        }
        $client = auth('client')->user();
        if (auth('client')->check()) {
            $this->name      = $client->name;
            $this->phone     = $client->phone;
            $this->email     = $client->email;
            $this->addresses = $client->addresses;
        }

        
        
        $this->SelectedCountry = DefaultCurrancy()->id;
        $this->phone_length = DefaultCurrancy()->length;
        $this->AllRegions = Region::where('country_id', DefaultCurrancy()->id)->Active()->get();
        $this->AllCities = collect();
    }
    
    public function render()
    {   
        $this->payments = Payment::with('Images')->Active()->when($this->SelectedCountry != 1, function ($query) {
            return $query->where('id','!=',1);
        })->get();
        
         // Check if there are any payments before accessing the first one
        if ($this->payments->isNotEmpty() && $this->payment == NULL) {
            $this->payment = $this->payments->first()->id;
        }
            
        $this->Cart = [];
        $this->SubTotal = 0;
        $this->vat_total = 0;
        $this->Vat = 0;
        $this->weight = 0;
        $this->Discount = 0;
        $this->discount_percentage = 0;
        $this->coupon = 0;
        $this->OnlineVat = 0;

        if ($this->cart->count()) {
            foreach ($this->cart as $CartItem) {
                $Product = $this->Products->where('id', $CartItem['product_id'])->first();
                
                $this->weight += $Product->weight *  $CartItem['quantity'];
                
                $SelectedSizeColor = $Product->SizeColor->where('size_id', $CartItem['size_id'])->when($CartItem['color_id'], function ($query) use ($CartItem) {
                    return $query->where('color_id', $CartItem['color_id']);
                })->first();
                $this->SubTotal += (float) $SelectedSizeColor->CalcPrice() * $CartItem['quantity'];
                $CartItem['price'] = (float) $SelectedSizeColor->CalcPrice();
                $CartItem['total'] = (float) $SelectedSizeColor->CalcPrice() * $CartItem['quantity'];
                if($Product->VAT == 'exclusive'){
                    $this->vat_total += (float) $SelectedSizeColor->CalcPrice() * $CartItem['quantity'];
                }else{
                    $this->vat_total += 0;
                }
                $CartItem['SelectedSizeColor'] = $SelectedSizeColor;
                $CartItem['Product'] = $Product;
                $this->Cart[] = collect($CartItem);
            }
        }

        $this->NetTotal = $this->SubTotal;
        $Setting_Dicount = setting('discount');
        if (($this->NetTotal - ($this->SubTotal * $Setting_Dicount / 100)) > 0) {
            $this->discount_percentage = $Setting_Dicount;
            $this->Discount = number_format($this->SubTotal * $Setting_Dicount / 100, DefaultCurrancy()->decimals);
            $this->NetTotal = $this->NetTotal - $this->Discount;
        }

        $Setting_VAT = setting('VAT') ?? 0.000;
        if (($this->NetTotal - (($this->vat_total - $this->Discount) * $Setting_VAT / 100)) > 0  && $this->vat_total > 0) {
            $this->VAT_percentage = $Setting_VAT;
            $this->Vat = ($this->SubTotal - $this->Discount) * $Setting_VAT / 100;
            $this->NetTotal = $this->NetTotal + $this->Vat;
        }

        if ($this->code) {
            $Coupon = Coupon::where('code', $this->code)->first();
            if ($Coupon) {
                if ($Coupon->percent_off) {
                    if (($this->NetTotal - ($this->SubTotal * $Coupon->percent_off / 100)) >= 0) {
                        $this->coupon_percentage = $Coupon->percent_off;
                        $this->coupon = number_format($this->SubTotal * $Coupon->percent_off / 100, DefaultCurrancy()->decimals);
                        $this->NetTotal = $this->NetTotal - $this->coupon;
                    }
                } elseif ($Coupon->discount) {
                    if (($this->NetTotal - $Coupon->discount) >= 0) {
                        $this->coupon_percentage = $Coupon->discount ? ($this->SubTotal - $this->NetTotal * $Coupon->discount / 100) : null;
                        $this->coupon = number_format($Coupon->discount, DefaultCurrancy()->decimals);
                        $this->NetTotal = $this->NetTotal - $this->coupon;
                    }
                }
            }
        }
        $this->NetTotal = (float)$this->NetTotal + (float)$this->delivery_cost;
        if(setting('OnlineVat') && $this->payment > 1){
            if($this->SelectedCountry == 1){
                $this->OnlineVat = ($this->NetTotal / 100 * $this->payments->where('id',$this->payment)->first()->vat_local ); 
            }else{
                $this->OnlineVat = ($this->NetTotal / 100 * $this->payments->where('id',$this->payment)->first()->vat_global ); 
            }
        }
        $this->NetTotal = $this->NetTotal + $this->OnlineVat;
        return view('Tenant.User.components.Cart.cart-livewire')->extends('User.layouts.layout')->section('content');
    }
    
    
    public function updatedName($value)
    {
        CartModel::where('client_id',client_id())->update(['name'=>$value]);
    }
    
    
    public function updatedPhone($value)
    {
        CartModel::where('client_id',client_id())->update(['phone'=>$value]);
    }
    
    public function updatedEmail($value)
    {
        CartModel::where('client_id',client_id())->update(['email'=>$value]);
    }
    
    
    
    public function updatedAddress($value)
    {
        $address = $this->addresses->where('id',$value)->first();
        $this->latitude = $address->lat;
        $this->longitude = $address->long;
        if($this->latitude && $this->longitude){
            $Branches = [];
            foreach($this->branches as $Branch){
                $Branches[] = [
                    'distance' => distance($this->latitude,$this->longitude,$Branch->lat,$Branch->long),
                    'branch' => $Branch,
                ];
            }
            $ShortBranch = collect($Branches)->sortBy('distance')->first();
            $Branch = $ShortBranch['branch'];
            $this->delivery_cost = delivery_cost($this->latitude,$this->longitude,$Branch->lat,$Branch->long,$ShortBranch['distance'],$this->SelectedCountry,$this->weight);   
            $this->distance = $ShortBranch['distance'];
        }
    }
    
    public function updatedLongitude($value)
    {
        if($this->latitude && $this->longitude){
            $Branches = [];
            foreach($this->branches as $Branch){
                $Branches[] = [
                    'distance' => distance($this->latitude,$this->longitude,$Branch->lat,$Branch->long),
                    'branch' => $Branch,
                ];
            }
            $ShortBranch = collect($Branches)->sortBy('distance')->first();
            $Branch = $ShortBranch['branch'];
            $this->delivery_cost = delivery_cost($this->latitude,$this->longitude,$Branch->lat,$Branch->long,$ShortBranch['distance'],$this->SelectedCountry,$this->weight);   
            $this->distance = $ShortBranch['distance'];
        }
    }
    
    public function updatedRegionId($value)
    {
        $this->AllCities = City::where('region_id', $value)->Active()->get();
    }
    
    public function updatedSelectedCountry($value)
    {
        $this->latitude = NULL;
        $this->longitude = NULL;
        $this->delivery_cost = NULL;   
        $this->distance = NULL;
        $this->phone = null;
        $this->AllRegions = Region::where('country_id', $value)->Active()->get();
        $this->phone_length = $this->AllCountries->where('id', $value)->first()->length;
    }
    
    public function PLUS($Product_id, $size_id, $color_id = null, $quantity = 1, $note = '')
    {
        $Product = Product::with('SizeColor')->findorfail($Product_id);
        $SizeColor = $Product->SizeColor;
        if ($color_id) {
            $SizeColor = $SizeColor->where('color_id', $color_id);
        }
        if ($size_id) {
            $SizeColor = $SizeColor->where('size_id', $size_id);
        }
        $SizeColor = $SizeColor->first();

        if (! $SizeColor || $quantity < 1 || $SizeColor->quantity < $quantity) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('website.quantityNotenough')]);
        } else {
            
            $old_quantity = CartModel::where(['client_id' => client_id(),'product_id' => $Product_id,'color_id' => $color_id,'size_id' => $size_id,])->value('quantity');
            if (($old_quantity + $quantity) <= $SizeColor->quantity) {
                CartModel::updateOrCreate(
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
                        'quantity' => (int) ($old_quantity + $quantity),
                        'note' => $note,
                    ]
                );
                $this->cart = CartModel::where('client_id',client_id())->get();
                $this->dispatchBrowserEvent('RefreshCartModal');
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('website.quantityNotenough')]);
            }
        }
    }

    public function MINUS($Product_id, $size_id, $color_id = null, $quantity = 1, $note = '')
    {
        $old_quantity = CartModel::where(['client_id' => client_id(),'product_id' => $Product_id,'color_id' => $color_id,'size_id' => $size_id,])->value('quantity');
        if ($quantity >= 1 && $old_quantity > 1) {
            CartModel::updateOrCreate(
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
                    'quantity' => (int) ($old_quantity - $quantity),
                    'note' => $note,
                ]
            );
            $this->cart = CartModel::where('client_id',client_id())->get();
        }
        $this->dispatchBrowserEvent('RefreshCartModal');
    }

    public function Delete($id)
    {
        CartModel::where('id',$id)->delete();
        $this->cart = CartModel::where('client_id',client_id())->get();
        $this->dispatchBrowserEvent('RefreshCartModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('messages.DeletedSuccessfully')]);
    }

    public function increaseStep()
    {
        if (Setting::where('key', 'accept_order')->first()->value) {
            if ($this->currentStep == 1) {
                $this->currentStep++;
            } elseif ($this->currentStep == 2) {
                if ($this->delivry_method) {
                    if (! is_null($this->delivry_method)) {
                        $this->resetErrorBag();
                        $this->validateData();
                    }
                    $this->currentStep++;
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('dashboard.DeliveryMethod').' '.__('messages.required')]);
                }
            } elseif ($this->currentStep == 3) {
                $this->resetErrorBag();
                $this->validateData();
            }
            if ($this->currentStep > $this->totalSteps) {
                $this->currentStep = $this->totalSteps;
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('dashboard.dont_accept_orders')]);
        }
    }

    public function decreaseStep()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {
        $rules = [];
        if ($this->delivry_method == 1 && ! $this->address) {
            $rules += [
                'region_id' => 'required|string',
                // 'city_id' => 'required|string',
                'block' => 'required|string',
                'road' => 'required|string',
                'building_no' => 'nullable|string',
                'floor_no' => 'nullable|string',
                'apartment' => 'nullable|string',
                'type' => 'nullable|string',
                'additional_directions' => 'sometimes',
                'latitude' => 'required',
                'longitude' => 'required',
            ];
        } elseif ($this->delivry_method == 2) {
            $rules += [
                'branch' => 'required',
            ];
        }

        if (! auth('client')->check()) {
            $rules += [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
            ];
        }
        $rules += [
            'payment' => 'required|exists:payments,id',
        ];
        
        if (count($rules)) {
            $this->validate($rules);
        }
    }

    public function SubmitCouponCode()
    {
        if ($this->code) {
            $Coupon = Coupon::where('code', $this->code)->first();
            if ($Coupon) {
                if ($Coupon->percent_off) {
                    $this->coupon = number_format($this->SubTotal * $Coupon->percent_off / 100, DefaultCurrancy()->decimals);
                    $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('website.code_applied', ['coupon_value_number' => $this->coupon]).DefaultCurrancy()->currancy_code]);
                    $this->NetTotal = $this->NetTotal - $this->coupon;
                    
                } elseif ($Coupon->discount) {
                    if (($this->NetTotal - $Coupon->discount) > 0) {
                        $this->coupon = number_format($Coupon->discount, DefaultCurrancy()->decimals);
                        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('website.code_applied', ['coupon_value_number' => $this->coupon]).DefaultCurrancy()->currancy_code]);
                        $this->NetTotal = $this->NetTotal - $this->coupon;
                    }
                }
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('messages.invalidCoupon')]);
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('messages.invalidCoupon')]);
        }
        
        if($this->NetTotal < 0 ){
            $this->NetTotal = 0;
        }
    }

    public function confirmOrder()
    {
        if (Setting::where('key', 'accept_order')->first()->value) {
            $this->resetErrorBag();
            $this->validateData();
            
            if (auth('client')->check()) {
                $ClientId = auth('client')->id();
            } else {
                $Client = Client::where('phone', 'LIKE', "%{$this->phone}%")->where('email', 'LIKE', "%{$this->email}%")->first();
                if ($Client) {
                    $ClientId = $Client->id;
                } else {
                    $Client = Client::create([
                        'name' => $this->name,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'country_code' => Countries()->where('id',$this->SelectedCountry)->first()->country_code,
                        'phone_code' => Countries()->where('id',$this->SelectedCountry)->first()->phone_code,
                        'password' => Hash::make('password'),
                    ]);
                    $ClientId = $Client->id;
                }
            }

            $Client = Client::where('id', $ClientId)->first();

            if ($this->delivry_method == 1) {
                if ($this->address) {
                    $address_id = $this->address;
                } else {
                    $Address = Address::create([
                        'client_id' => $ClientId,
                        'region_id' => $this->region_id,
                        'city_id' => $this->city_id,
                        'block' => $this->block,
                        'road' => $this->road,
                        'building_no' => $this->building_no,
                        'floor_no' => $this->floor_no,
                        'apartment' => $this->apartment,
                        'type' => $this->type,
                        'additional_directions' => $this->additional_directions,
                        'lat' => $this->latitude,
                        'long' => $this->longitude,
                    ]);
                    $address_id = $Address->id;
                }
            } else {
                $address_id = null;
            }

            $Order = Order::create([
                
                'delivery_company_id' => isset($this->SelectedCountry) ? ( $this->SelectedCountry == 1 ?  tenant()->delivry_id_in : tenant()->delivry_id_out) : '',
            
                'client_id' => $ClientId,
                'delivery_id' => $this->delivry_method,
                'address_id' => $address_id,
                'branch_id' => $this->branch,
                'payment_id' => $this->payment,
                'note' => $this->note,
                'OnlineVat' => $this->OnlineVat / DefaultCurrancy()->currancy_value,

                'sub_total' => $this->SubTotal / DefaultCurrancy()->currancy_value,
                'discount' => $this->Discount / DefaultCurrancy()->currancy_value,
                'vat' => $this->Vat / DefaultCurrancy()->currancy_value,
                'coupon' => $this->coupon / DefaultCurrancy()->currancy_value,
                'coupon_percentage' => $this->coupon_percentage ?? 0,
                'charge_cost' => $this->delivery_cost / DefaultCurrancy()->currancy_value,
                'net_total' => $this->NetTotal / DefaultCurrancy()->currancy_value,
                'mobile_type' => 'web',
            ]);

            foreach ($this->Cart as $key => $item) {
                $OrderProduct = $Order->OrderProducts()->create([
                    'order_id' => (int) $Order['id'],
                    'product_id' => (int) $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total' => $item['total'],
                    'color_id' => $item['color_id'] > 0 ? $item['color_id'] : null,
                    'size_id' => $item['size_id'] > 0 ? $item['size_id'] : null,
                ]);

                $ProductSizeColor = ProductSizeColor::where('product_id', (int) $item['product_id'])->where('size_id', $item['size_id'])->when($item['color_id'], function ($query) use ($item) {
                    return $query->where('color_id', $item['color_id']);
                })->decrement('quantity', (int) $item['quantity']);
            }

            if ($this->payment == 1) {
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('messages.order_added_successfully')]);
                alert()->success(__('messages.order_added_successfully'));
                CartModel::where('client_id',client_id())->delete();
                ResponseHelper::send_notification_for_new_order();
                WhatsApp::SendOrder($Order);
                try {
                //   Mail::to(['apps@emcan-group.com', setting('email'), $Client->email])->send(new OrderSummary($Order));
                } catch (Exception $e) {
                    
                }
                return redirect()->route('client.home');
            } else{//TAP
                $Order->status = 5;
                $Order->save();
                $Client = Client::find($ClientId);

                return redirect()->away(VerifyTapTransaction(env('TAP_SECRET'), $Order->id, $ClientId, $this->NetTotal, 0, $this->NetTotal, $Client->name, '', '', $Client->phone, $Client->email, 'BHD','https://'. request()->getHost().'/payment/tap/response' , $this->payments->where('id',$this->payment)->first()->tap_src ));
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('dashboard.dont_accept_orders')]);
        }
    }
}
