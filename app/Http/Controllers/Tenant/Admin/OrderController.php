<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Helper\WhatsApp;
use App\Mail\OrderSummary;
use App\Models\Client;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Tenant\Order;
use App\Models\Tenant\ProductSizeColor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:orders-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:orders-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:orders-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:orders-delete', ['only' => ['destroy']]);
    }

    public function index($method, Request $request)
    {
        $Countries = Country::all();
        $Orders = Order::with(['PaymentMethod', 'OrderProducts', 'address.region'])->latest()
            ->when(request()->id, function ($query) {
                return $query->where('id', request()->id);
            })
            ->when($method == 'new', function ($query) {
                return $query->where('status', 0);
            })
            ->when($method == 'current', function ($query) {
                return $query->where('status', 1)->whereIn('follow', [0, 1, 2]);
            })
            ->when($method == 'previous', function ($query) {
                return $query->where('status', 1)->whereIn('follow', [3]);
            })
            ->when($method == 'declined', function ($query) {
                return $query->where('status', 2);
            })->paginate(25);
                
        $last_order_id = Order::orderby('id', 'desc')->first()->id ?? 0;
        return view('Tenant.Admin.orders.index', compact('method', 'Orders', 'Countries', 'last_order_id'));
    }
    
        
    public function last_order_id( Request $request)
    {
        return response()->json(Order::where('id','>',$request->last_order_id)->where('status', 0)->count());
    }


    public function preview($id)
    {
        $Order = Order::findorfail($id);
        return view('Tenant.Admin.orders.preview', compact('Order'));
    }


    public function show(Order $Order)
    {
        return view('Tenant.Admin.orders.show', compact('Order'));
    }

    public function destroy(Order $Order)
    {
        $Order->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
    
     public function changestatus(Request $request)
     {
         $Order = Order::where('id', $request->id)->first();
         $Client = Client::where('id', $Order->client_id)->first();
         if ($Order->delivery_id == 1) {
             if ($request->status == 2) {
                 $msg = 'order_rejected';
             } elseif ($request->status == 1 && $request->follow == 2) {
                 $msg = 'order_onway';
             } elseif ($request->status == 1 && $request->follow == 3) {
                 $msg = 'order_delivered';
             } elseif ($request->status == 1 && $request->follow == 1) {
                 $msg = 'order_preparing';
                 $country = $Order->address()->first()->region()->first()->country()->first();
                 if($country->id == 1){
                    $order_delivery = DB::connection('mysql')->table('tenants')->where('id',tenant()->id)->value('delivry_id_in');
                 }else{
                    $order_delivery = DB::connection('mysql')->table('tenants')->where('id',tenant()->id)->value('delivry_id_out');
                 }
                 if($order_delivery == 1){
                    $Task = \App\Helper\Delivery\Parcel::CreateTask($Order);
                    if ($Task && isset($Task['status']) && $Task['status'] == 200 && isset($Task['date'])) {
                         \App\Models\Tenant\Order::where('id', $Order->id)->update([
                            'store_tracking_link' => $Task['date']['trackingLink'],
                            'pickupId' => $Task['date']['pickupId'],
                            'client_tracking_link' => $Task['date']['deliveries']['trackingLink'],
                            'deliveryId' => $Task['date']['deliveries']['deliveryId']
                        ]);
                    }
                 }elseif($order_delivery == 2){
                    $Task = \App\Helper\Delivery\Ubex::CreateTask($Order);
                            
                    if ($Task && isset($Task['status']) && $Task['status'] == 200 && isset($Task['data'])) {
                        \App\Models\Tenant\Order::where('id', $Order->id)->update([
                            'client_tracking_link' => $Task['data']['tracking_url'],
                            'deliveryId' => $Task['data']['tracking'],
                        ]);
                    }
                 }elseif($order_delivery == 3){
                    $Task = \App\Helper\Delivery\ISCO::CreateTask($Order);
                    if ($Task && isset($Task['status']) && $Task['status'] == 200 && isset($Task['data'])) {
                        $Order->client_tracking_link = $Task['data']['tracking_link'];
                        $Order->deliveryId = $Task['data']['job_id'];
                        $Order->save();
                    }
                 }elseif($order_delivery == 4){
                    $Task = \App\Helper\Delivery\Smsa::CreateTask($Order);
                    dd($Task);
                    if ($Task && isset($Task['status']) && $Task['status'] == 200) {
                        $Order->store_tracking_link = $Task['tracking_url'];
                        $Order->client_tracking_link = $Task['tracking_url'];
                        $Order->save();
                    }
                 }elseif($order_delivery == 5){
                    $Task = \App\Helper\Delivery\Oreem::CreateTask($Order);
                    if ($Task && isset($Task['status']) && $Task['status'] == 200) {
                        $Order->store_tracking_link = $Task['tracking_url'];
                        $Order->client_tracking_link = $Task['tracking_url'];
                        $Order->save();
                    }
                 }elseif($order_delivery == 6){
                    $Task = \App\Helper\Delivery\ShareMe::CreateTask($Order);
                    if ($Task && isset($Task['statusCode']) && $Task['statusCode'] == 200) {
                        $Order->store_tracking_link = isset($Task['payload']['tracking_url']) ? $Task['payload']['tracking_url'] : NULL;
                        $Order->client_tracking_link = isset($Task['payload']['tracking_url']) ? $Task['payload']['tracking_url'] : NULL;
                        $Order->save();
                    }
                 }elseif($order_delivery == 7){
                    $Task = \App\Helper\Delivery\Delybell::CreateTask($Order);
                 }
             } else {
                 $msg = 'updatedSuccessfully';
             }
         } 
         
         if ($Order->delivery_id > 1) {
             if ($request->status == 2) {
                 $msg = 'order_rejected';
             } elseif ($request->status == 1 && $request->follow == 1) {
                 $msg = 'order_preparing';
             } elseif ($request->status == 1 && $request->follow == 2) {
                 $msg = 'order_ready';
             } elseif ($request->status == 1 && $request->follow == 3) {
                 $msg = 'order_delivered';
             } else {
                 $msg = 'updatedSuccessfully';
             }
         }
         
         if (intval($request->status) == 4) {
             foreach ($Order->products as $key => $item) {
                 $product = ProductSizeColor::where('product_id', $item->pivot->product_id)->where('color_id', $item->pivot->color_id > 0 ? $item->pivot->color_id : null)->where('size_id', $item->pivot->size_id > 0 ? $item->pivot->size_id : null)->first();
                 $product->quantity = intval($product->quantity) + intval($item->pivot->quantity);
                 $product->save();
             }
         }
         Notification::create([
             'title_ar' => __('messages.'.$msg, [], 'ar'),
             'title_en' => __('messages.'.$msg, [], 'en'),
             'type' => 'order_updated',
             'client_id' => $Order->client_id,
         ]);
         ResponseHelper::send_notification(__('messages.'.$msg, [], Client::where('id', $Order->client_id)->value('lang')), ['type' => 'order_updated', 'order_id' => $Order->id], $Order->client_id);
         
         
         
        $message  = '%0a *(' .env('APP_NAME').')* %0a';
        $message .= '%0a *Order Number :* ' . $Order->id;
        $message .= '%0a '.__('messages.'.$msg).' %0a';
        $message .= '%0a *Powered By Emcan Solutions* %0a';
        
        
        WhatsApp::SendWhatsApp($Order->client()->first()->phone_code . $Order->client()->first()->phone,$message);
        
        
         $Order->status = $request->status;
         $Order->follow = $request->follow;
         $Order->save();
         
         alert()->success(__('messages.'.$msg));
         return redirect()->back()->with([
             'message' => __('messages.'.$msg),
         ]);
     }
}
