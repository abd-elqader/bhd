<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Helper\WhatsApp;
use App\Http\Resources\Tenant\OrderRescource;
use App\Models\Tenant;
use App\Models\Tenant\Cart;
use App\Models\Tenant\Address;
use App\Models\Payment;
use App\Models\Tenant\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $Owner = $this->user->DeviceTokens->count();
        $Orders = Order::query()
                ->latest()
                ->when(!$Owner, function ($query) {
                    return $query>where('client_id', $this->user->id);
                })
                ->when($request->method == 'current', function ($query) {
                    return $query->whereIn('status', [0,1])->whereIn('follow', [0, 1, 2]);
                })
                ->when($request->method == 'previous' || $request->method == 'last', function ($query) {
                    return $query->whereIn('status', [1])->whereIn('follow', [3]);
                })
                ->when($request->status, function ($query) use ($request) {
                    return $query->where('status', $request->status);
                })
                ->when($request->follow, function ($query) use ($request) {
                    return $query->where('follow', $request->follow);
                })
                ->get();
        $this->CheckCount($Orders);

        return ResponseHelper::make(OrderRescource::collection($Orders));
    }

    public function store($lang, Request $request)
    {
        if (tenant()->paid == 0) {
            return ResponseHelper::make(null, __('dashboard.expired'), false, 200);
        }
        
        $this->CheckAuth();
        $Cart = Cart::with('Product')->where('client_id', $this->user->id)->get();
        $this->CheckCount($Cart);
        $data = $this->CartCalculations($Cart, $request);

        $Order = Order::create([
            'delivery_company_id' => isset($data['country_id']) ? ( $data['country_id'] == 1 ?  tenant()->delivry_id_in : tenant()->delivry_id_out) : '',
            'client_id' => $this->user->id,
            'delivery_id' => $request->delivery_id,
            'payment_id' => $request->payment_id,
            'address_id' => $request->address_id ?? null,
            'branch_id' => $request->branch_id ?? null,
            'sub_total' => $data['subTotal_value'],
            'OnlineVat' => $data['OnlineVat'] ?? 0,
            'discount' => $data['discount_value_number'],
            'discount_percentage' => $data['discount_percentage'] ?? 0.00,
            'vat' => $data['VAT_value_number'],
            'vat_percentage' => $data['VAT_percentage'] ?? 0.00,
            'coupon' => $data['coupon_value_number'] ?? 0,
            'coupon_percentage' => $data['coupon_percentage'] ?? 0,
            'charge_cost' => isset($data['delivery_cost_value_number']) ? $data['delivery_cost_value_number'] + ($data['address_cost_value_number'] ?? 0) : 0,
            'net_total' => $data['netTotal_value'],
            'mobile_type' => $request->mobile_type,
        ]);
        
        foreach ($Cart as $Item) {
            $Order->Products()->attach($Item['product_id'], [
                'size_id' => $Item->size->id,
                'color_id' => $Item->Color?->id ?? null,
                'price' => $Item->price_after_discount,
                'quantity' => $Item->quantity,
                'total' => $Item->total_after_discount,
            ]);
        }
        
        if ($request->payment_id == 5) {//TAP
            return ResponseHelper::make(VerifyTapTransaction(env('TAP_SECRET'), $Order->id, $this->user->id, $data['netTotal_value'], $vat_added = 0, $data['netTotal_value'], $this->user->name, '', '', $this->user->phone, $this->user->email, $currency = 'BHD', $redirect_url = 'https://'.request()->getHost().'/payment/tap/response', Payment::where('id',$request->payment_id)->first()->tap_src ));
        }
        Cart::where('client_id', $this->user->id)->delete();
        
        return ResponseHelper::make(null, __('messages.addedSuccessfully'));
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $Order = Order::where('id', $id)->first();
        $this->CheckExist($Order);

        return ResponseHelper::make(OrderRescource::make($Order));
    }

    public function update($lang, $id, OrderRequest $request)
    {
        $this->CheckAuth();
        $Order = Order::where('client_id', $this->user->id)->where('id', $id)->first();
        $this->CheckExist($Order);
        $Order->update($request->validated());

        return ResponseHelper::make(OrderRescource::make($Order), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id)
    {
        $this->CheckAuth();
        $Order = Order::where('client_id', $this->user->id)->where('id', $id)->delete();

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }
}
