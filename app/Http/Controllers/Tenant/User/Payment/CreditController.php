<?php

namespace App\Http\Controllers\Tenant\User\Payment;

use App\Helper\WhatsApp;
use App\Http\Controllers\Controller;
use App\Mail\OrderSummary;
use App\Models\Client;
use App\Models\Tenant\Order;
use App\Models\Tenant\ProductSizeColor;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;

class CreditController extends Controller
{
    public function init()
    {
        $request = request()->all();
        $request['CREDIT_ID'] = setting('CREDIT_ID');
        $request['CREDIT_SECRET'] = setting('CREDIT_SECRET');
        $request['APP_NAME'] = env('APP_NAME');
        $request['APP_URL'] = env('APP_URL');

        return view('Payment.Credit.init')->with($request);
    }

    public function response()
    {
        $Client = Client::find(request()->clientID);
        $Order = Order::find(request()->order_id);
        if (request()->result == 'complete') {
            $Order->status = 0;
            $Order->save();
            Transaction::create([
                'client_id' => request()->clientID,
                'order_id' => request()->order_id,
                'transaction_number' => request()->resultIndicator,
                'value' => $Order->net_total,
                'result' => 'Success',
                'type' => 'Credit',
            ]);
            foreach ($Order->OrderProducts as $Item) {
                ProductSizeColor::query()
                    ->where('product_id', (int) $Item['product_id'])
                    ->where('size_id', $Item['size_id'])
                    ->when($Item['color_id'] ?? null, function ($query) use ($Item) {
                        return $query->where('color_id', $Item['color_id']);
                    })->decrement('quantity', (int) $Item['quantity']);
            }
            Mail::to(['apps@emcan-group.com', setting('email'), $Client->email])->send(new OrderSummary($Order));
            alert()->success(__('messages.successProcess'));
            alert()->success(__('messages.order_added_successfully'));
            session()->forget('cart');
            session()->save();
            WhatsApp::SendOrder($Order);

            return redirect()->route('client.home');
        } else {
            Transaction::create([
                'client_id' => request()->clientID,
                'order_id' => request()->order_id,
                'transaction_number' => request()->resultIndicator ?? null,
                'value' => $Order->net_total,
                'result' => 'Failed',
                'type' => 'Credit',
            ]);
            alert()->error(__('messages.failedProcess'));
        }

        return redirect()->route('client.home');
    }
}
