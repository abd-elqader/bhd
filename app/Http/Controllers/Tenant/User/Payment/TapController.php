<?php

namespace App\Http\Controllers\Tenant\User\Payment;

use App\Helper\ResponseHelper;
use App\Helper\WhatsApp;
use App\Http\Controllers\Controller;
use App\Mail\OrderSummary;
use App\Models\Tenant\Cart;
use App\Models\Tenant\Order;
use App\Models\Tenant\ProductSizeColor;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;

class TapController extends Controller
{
    public function response()
    {
        $charge_data = ResponseTapTransaction(env('TAP_SECRET_KEY'), request()->tap_id);
        $Order = Order::with('client')->where('transaction_number', request()->tap_id)->first();
        $Client = $Order->client;
        Transaction::create([
            'client_id' => $Client->id,
            'order_id' => $Order->id,
            'transaction_number' => $charge_data['id'],
            'value' => $charge_data['amount'],
            'result' => $charge_data['status'],
            'type' => 'TAP',
        ]);

        if ($charge_data['status'] == 'PAID' || $charge_data['status'] == 'CAPTURED') {
            $Order->status = 0;
            $Order->save();
            foreach ($Order->OrderProducts as $Item) {
                ProductSizeColor::query()
                    ->where('product_id', (int) $Item['product_id'])
                    ->where('size_id', $Item['size_id'])
                    ->when($Item['color_id'] ?? null, function ($query) use ($Item) {
                        return $query->where('color_id', $Item['color_id']);
                    })->decrement('quantity', (int) $Item['quantity']);
            }
            
            WhatsApp::SendOrder($Order);
            // Mail::to(['apps@emcan-group.com', setting('email'), $Client->email])->send(new OrderSummary($Order));
            ResponseHelper::send_notification_for_new_order();
                 
            Cart::where('client_id', client_id())->delete();

            if($Order->mobile_type == 'ios' || $Order->mobile_type == 'android'){
                return redirect()->away('https://'.request()->getHost().'/api/en/payment/success');
            }else{
                alert()->success(__('messages.order_added_successfully'));
                alert()->success(__('messages.successProcess'));
                return redirect()->route('client.home', ['alert' => [
                        ['type' => 'success', 'message' => __('messages.order_added_successfully')],
                        ['type' => 'success', 'message' => __('messages.successProcess')],
                    ],
                ]);
            }
        } else {
            if($Order->mobile_type == 'ios' || $Order->mobile_type == 'android'){
                return redirect()->away('https://'.request()->getHost().'/api/en/payment/failed');
            }else{
                alert()->error(__('messages.failedProcess'));
                return redirect()->route('client.home', ['alert' => [
                        ['type' => 'error', 'message' => __('messages.failedProcess')],
                    ],
                ]);
            }
        }
    }
}

