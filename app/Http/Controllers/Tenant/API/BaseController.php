<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Payment;
use App\Models\Tenant\Address;
use App\Models\Tenant\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    public $user;

    public $currency_id;

    public function __construct(Request $request)
    {
        app()->setLocale($request->lang ?? 'en');
    }

    public function CheckAuth()
    {
        if (! auth('sanctum')->check()) {
            return ResponseHelper::make(null, __('messages.You not auth'), true, 404);
        } else {
            $this->user = auth('sanctum')->user();
        }
    }

    public function CheckCount($Data)
    {
        if ($Data->count() < 1) {
            return ResponseHelper::make([], __('messages.Data not found'), true, 404);
        }
    }

    public function CheckExist($Model)
    {
        if (! $Model) {
            return ResponseHelper::make(null, __('messages.Data not found'), true, 404);
        }
    }

     public function CartCalculations($Cart, Request $request)
     {
         $Cart = collect($Cart);
         $subTotal = $Cart->sum('total_after_discount');
         $netTotal = $subTotal;

         $data['subTotal_value'] = number_format($subTotal, DefaultCurrancy()->decimals, '.', '');
         $data['subTotal'] = number_format($subTotal, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
         
         
         $Setting_Dicount = setting('discount');
         $data['discount'] = $Setting_Dicount > 0 ? true : false;
         $data['discount_percentage'] = $Setting_Dicount ? (int) $Setting_Dicount : null;
         $discount_value = number_format($subTotal * $Setting_Dicount / 100, DefaultCurrancy()->decimals, '.', '');
         $data['discount_value'] = $discount_value.' '.DefaultCurrancy()->currancy_code;
         $data['discount_value_number'] = $discount_value;
         $netTotal = $netTotal - $discount_value;

         $Setting_VAT = setting('VAT') ?? 0.000;
         $data['VAT'] = $Setting_VAT > 0 ? true : false;
         $data['VAT_percentage'] = $Setting_VAT ? (int) $Setting_VAT : null;
         $VAT_value = number_format(($subTotal - $discount_value) * $Setting_VAT / 100, DefaultCurrancy()->decimals, '.', '');
         $data['VAT_value'] = $VAT_value.' '.DefaultCurrancy()->currancy_code;
         $data['VAT_value_number'] = $VAT_value;
         $netTotal = $netTotal + $VAT_value;

         if ($request->code) {
             $Coupon = Coupon::where('code', $request->code)->first();
             if ($Coupon) {
                 if ($Coupon->percent_off) {
                     $data['coupon_percentage'] = $Coupon->percent_off ? (int) $Coupon->percent_off : null;
                     $coupon_value = number_format($subTotal * $Coupon->percent_off / 100, DefaultCurrancy()->decimals, '.', '');
                     $data['coupon_value'] = $coupon_value.' '.DefaultCurrancy()->currancy_code;
                     $data['coupon_value_number'] = $coupon_value;
                     $data['code_message'] = __('website.code_applied', ['coupon_value_number' => $coupon_value]).DefaultCurrancy()->currancy_code;
                     $netTotal = $netTotal - $coupon_value;
                 } elseif ($Coupon->discount) {
                     $data['coupon'] = $Coupon->discount > 0 ? true : false;
                     $data['coupon_percentage'] = $Coupon->discount ? ($subTotal - $subTotal * $Coupon->discount / 100) : null;
                     $coupon_value = number_format($Coupon->discount, DefaultCurrancy()->decimals, '.', '');
                     $data['coupon_value'] = $coupon_value.' '.DefaultCurrancy()->currancy_code;
                     $data['coupon_value_number'] = $coupon_value;
                     $data['code_message'] = __('website.code_applied', ['coupon_value_number' => $coupon_value]).DefaultCurrancy()->currancy_code;
                     $netTotal = $netTotal - $coupon_value;
                 }
             } else {
                 $data['coupon'] = false;
                 $data['code_message'] = __('messages.invalidCoupon');
             }
         }

         if ($request->delivery_id == 1 && $subTotal > 0 && $request->address_id) {
            $Address = Address::where('id', $request->address_id)->first();
            $Branches = [];
            foreach(Branches() as $Branch){
                $Branches[] = [
                    'distance' => distance($Address->lat,$Address->long,$Branch->lat,$Branch->long),
                    'branch' => $Branch,
                ];
            }
            $ShortBranch = collect($Branches)->sortBy('distance')->first();
            $Branch = $ShortBranch['branch'];
            
             $Setting_delivery_cost = delivery_cost($Address->lat,$Address->long,$Branch->lat,$Branch->long,$request->same_day_price,$ShortBranch['distance']);
             $data['delivery_cost'] = $Setting_delivery_cost > 0 ? true : false;
             $delivery_cost_value = number_format($Setting_delivery_cost, DefaultCurrancy()->decimals, '.', '');
             $data['delivery_cost_value'] = $delivery_cost_value.' '.DefaultCurrancy()->currancy_code;
             $data['delivery_cost_value_number'] = $delivery_cost_value;
             $netTotal = $netTotal + $delivery_cost_value;
         }

        //  if ($request->address_id && $subTotal > 0) {
        //      $Address_delivery_cost = 0.000;
        //      $data['address_cost'] = $Address_delivery_cost > 0 ? true : false;
        //      $Address_delivery_cost_value = number_format($Address_delivery_cost, DefaultCurrancy()->decimals, '.', '');
        //      $data['address_cost_value'] = $Address_delivery_cost_value .' '. DefaultCurrancy()->currancy_code;
        //      $data['address_cost_value_number'] = $Address_delivery_cost_value;
        //  }

        if(setting('OnlineVat') && $request->payment_id > 1){
            if(!$request->country_id || $request->country_id == 1){
                $OnlineVat = ($netTotal / 100 * Payment::where('id',$request->payment_id)->first()->vat_local ); 
            }else{
                $OnlineVat = ($netTotal / 100 * Payment::where('id',$request->country_id)->first()->vat_global ); 
            }
        }
        $data['OnlineVat_value'] = number_format($OnlineVat, DefaultCurrancy()->decimals, '.', '');
        $data['OnlineVat'] = number_format($OnlineVat, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;
        
        $netTotal = $netTotal + $OnlineVat;
        $data['netTotal_value'] = number_format($netTotal, DefaultCurrancy()->decimals, '.', '');
        $data['netTotal'] = number_format($netTotal, DefaultCurrancy()->decimals, '.', '').' '.DefaultCurrancy()->currancy_code;

         return $data;
     }
}
