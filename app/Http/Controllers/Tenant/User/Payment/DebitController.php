<?php

namespace App\Http\Controllers\Tenant\User\Payment;

use App\Http\Controllers\Controller;
use App\Mail\OrderSummary;
use App\Models\Client;
use App\Models\Tenant\Order;
use App\Models\Tenant\ProductSizeColor;
use App\Models\Transaction;
use App\WhatsApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DebitController extends Controller
{
    public function init(Request $request)
    {
        $response = route('client.payment.debit.response');
        $error = route('client.payment.debit.error');
        require 'Payments/plugin/iPayBenefitPipe.php';
        $myObj = new \iPayBenefitPipe();
        $myObj->setResourcePath('Payments/resource/');
        $myObj->setKeystorePath('Payments/resource/');
        $myObj->setAlias(setting('DEBIT_ALIASNAME'));
        $myObj->setAction('1');
        $myObj->setCurrency('048');
        $myObj->setLanguage('USA');
        $myObj->setResponseURL($response);
        $myObj->setErrorURL($error);
        $myObj->setAmt($request->amount);
        $myObj->setTrackId(rand(1, 1000000));
        $myObj->setUdf2('Udf2');
        $myObj->setUdf3($request->client_id);
        $myObj->setUdf4($request->order_id);
        $myObj->setUdf5('Udf5');
        if (trim($myObj->performPaymentInitializationHTTP()) != 0) {
            echo 'ERROR OCCURED! SEE CONSOLE FOR MORE DETAILS';

            return;
        } else {
            return redirect()->away($myObj->getwebAddress());
        }
    }

    public function response()
    {
        require 'Payments/plugin/iPayBenefitPipe.php';
        $myObj = new \iPayBenefitPipe();

        $myObj->setResourcePath('Payments/resource/');
        $myObj->setKeystorePath('Payments/resource/');
        $myObj->setAlias(setting('DEBIT_ALIASNAME'));

        if (! empty(($_SERVER['QUERY_STRING']))) {
            parse_str($_SERVER['QUERY_STRING']);
        } else {
            $trandata = isset($_GET['trandata']) ? $_GET['trandata'] : (isset($_POST['trandata']) ? $_POST['trandata'] : '');
            $returnValue = $myObj->parseEncryptedRequest($trandata);
        }

        $Result = $myObj->getResult();
        $PaymentId = $myObj->getPaymentId();
        $client_id = $myObj->getUdf3();
        $order_id = $myObj->getUdf4();

        if ($Result == 'CAPTURED') {
            $URL = route('client.payment.debit.success');
            echo 'REDIRECT='.$URL.'?PaymentId='.$PaymentId.'&order_id='.$order_id.'&client_id='.$client_id.'&Result='.$Result;
        } elseif ($Result == 'NOT CAPTURED') {
            $URL = route('client.payment.debit.error');
            echo 'REDIRECT='.$URL.'?PaymentId='.$PaymentId.'&order_id='.$order_id.'&client_id='.$client_id.'&Result='.$Result;
        } else {
            $URL = route('client.payment.debit.error');
            echo 'REDIRECT='.$URL.'?PaymentId='.$PaymentId.'&order_id='.$order_id.'&client_id='.$client_id.'&Result='.$Result;
        }
    }

    public function success()
    {
        $order_id = request()->order_id;
        $PaymentId = request()->PaymentId;
        $client_id = request()->client_id;
        $Result = request()->Result;
        $order = Order::find($order_id);
        $client = Client::find($client_id);
        $order->status = 0;
        $order->save();
        if ($order) {
            Transaction::create([
                'client_id' => $client_id,
                'order_id' => $order_id,
                'transaction_number' => $PaymentId,
                'value' => $order->net_total,
                'result' => $Result,
                'type' => 'Debit',
            ]);
        }
        foreach ($order->OrderProducts as $Item) {
            ProductSizeColor::query()
            ->where('product_id', (int) $Item['product_id'])
            ->where('size_id', $Item['size_id'])
            ->when($Item['color_id'] ?? null, function ($query) use ($Item) {
                return $query->where('color_id', $Item['color_id']);
            })->decrement('quantity', (int) $Item['quantity']);
        }
        Mail::to(['apps@emcan-group.com', setting('email'), $client->email])->send(new OrderSummary($order));
        WhatsApp::SendOrder($order);
        session()->forget('cart');
        session()->save();
        alert()->success(__('messages.successProcess'));
        alert()->success(__('messages.order_added_successfully'));

        return redirect()->route('client.home');
    }

    public function error()
    {
        $order_id = request()->order_id;
        $PaymentId = request()->PaymentId;
        $client_id = request()->client_id;
        $Result = request()->Result;
        $order = Order::find($order_id);
        $client = Client::find($client_id);
        if ($order) {
            Transaction::create([
                'client_id' => $client_id,
                'order_id' => $order_id,
                'transaction_number' => $PaymentId,
                'value' => $order->net_total,
                'result' => $Result,
                'type' => 'Debit',
            ]);
        }
        alert()->error(__('messages.declinedProcess'));

        return redirect()->route('client.home');
    }
}
