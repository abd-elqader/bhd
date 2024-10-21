<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Exports\AllUsers;
use App\Exports\ClientExport;
use App\Exports\SalesExport;
use App\Exports\FinancialExport;
use App\Exports\MostSelling;
use App\Exports\AbandonedCarts;
use App\Exports\PaymentExport;
use App\Exports\Test;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Tenant\Order;
use App\Models\Tenant\OrderProduct;
use App\Models\Tenant\Cart;
use App\Models\Tenant\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function sales()
    {
        $orders = [];
        if (request('from') && request('to')) {
            $orders = Order::whereIn('status', [0, 1, 2, 9])
            ->when(request('from'), function ($query) {
                return $query->whereDate('created_at', '>=', request('from'));
            })
            ->when(request('to'), function ($query) {
                return $query->whereDate('created_at', '<=', request('to'));
            })
            ->get();
        }
        Session::put('reports_data', $orders);
        Session::put('reports_type', 'sales');
        return view('Tenant.Admin.report.sales', compact('orders'));
    }
    
    public function financial()
    {
        $orders = [];
        if (request('from') && request('to')) {
            $orders = Order::whereIn('status', [0, 1, 2, 9])
            ->when(request('from'), function ($query) {
                return $query->whereDate('created_at', '>=', request('from'));
            })
            ->when(request('to'), function ($query) {
                return $query->whereDate('created_at', '<=', request('to'));
            })
            ->get();
        }
        Session::put('reports_data', $orders);
        Session::put('reports_type', 'financial');

        return view('Tenant.Admin.report.financial', compact('orders'));
    }

    public function client()
    {
        $clients = Client::all();
        $client = null;
        if (request('client_id')) {
            $client = Client::find(request('client_id'));
        }
        $client ? Session::put('reports_data', $client->orders) : '';
        Session::put('reports_type', 'client');

        return view('Tenant.Admin.report.client', compact('client', 'clients'));
    }

    public function payment()
    {
        $reports = [];
        if (request('from') && request('to')) {
            $reports = Transaction::whereDate('created_at', '>=', request('from'))
                ->whereDate('created_at', '<=', request('to'))->get();
        }
        Session::put('reports_data', $reports);
        Session::put('reports_type', 'payment');

        return view('Tenant.Admin.report.payment', compact('reports'));
    }

    public function abandoned_carts()
    {
        $abandoned_carts = Cart::latest()->with(['Client','product' => function ($product) {
            $product->select('title_'.app()->getlocale(), 'id');
        }])->select('client_id','name','phone','email','product_id','created_at');
        
        if (request('from')) {
            $abandoned_carts = $abandoned_carts->where('created_at', '>=', request('from'));
        }
        if (request('to')) {
            $abandoned_carts = $abandoned_carts->where('created_at', '<=', request('to'));
        }

        $abandoned_carts = $abandoned_carts
            ->get();

        Session::put('reports_data', $abandoned_carts);
        Session::put('reports_type', 'abandoned_carts');

        return view('Tenant.Admin.report.abandoned_carts', compact('abandoned_carts'));
    }

    public function mostselling()
    {
        $MostSelling = OrderProduct::with(['product' => function ($product) {
            $product->select('title_'.app()->getlocale(), 'id');
        }])->select('product_id', DB::raw('COUNT(product_id) as count'), DB::raw('DATE(created_at)'));
        if (request('from')) {
            $MostSelling = $MostSelling->where('created_at', '>=', request('from'));
        }
        if (request('to')) {
            $MostSelling = $MostSelling->where('created_at', '<=', request('to'));
        }

        $MostSelling = $MostSelling
            ->groupBy('product_id')
            ->groupBy('created_at')
            ->orderby('count', 'DESC')
            ->get();

        Session::put('reports_data', $MostSelling);
        Session::put('reports_type', 'mostselling');

        return view('Tenant.Admin.report.mostselling', compact('MostSelling'));
    }

    public function vat()
    {
        $Orders = Order::whereIn('status', [0, 1, 2, 9])
            ->when(request('from'), function ($query) {
                return $query->whereDate('created_at', '>=', request('from'));
            })
            ->when(request('to'), function ($query) {
                return $query->whereDate('created_at', '<=', request('to'));
            })
            ->get();

        $amount = (float) $Orders->sum('net_total');
        $VatAmount = (float) $Orders->where('vat', '>', 0.000)->sum('net_total');
        $NoVatAmount = (float) $amount - $VatAmount;
        $vat = [
            'amount' => $amount,

            'VatAmount' => $VatAmount,
            'VatAmountPercentage' => $VatAmount / setting('VAT'),

            'NoVatAmount' => $NoVatAmount,
            'NoVatAmountPercentage' => 0,
        ];
        Session::put('reports_data', $vat);
        Session::put('reports_type', 'vat');

        return view('Tenant.Admin.report.vat', compact('vat'));
    }

    public function test()
    {
        $Products = Product::with('category')->get();
        $export = new Test([$Products]);

        return Excel::download($export, 'report- '.now().'.xlsx');
    }

    public function exportData()
    {
        if (Session::get('reports_type') == 'sales') {
            $export = new SalesExport([Session::get('reports_data')]);
        }
        if (Session::get('reports_type') == 'financial') {
            $export = new FinancialExport([Session::get('reports_data')]);
        }
        if (Session::get('reports_type') == 'client') {
            $export = new ClientExport([Session::get('reports_data')]);
        }
        if (Session::get('reports_type') == 'payment') {
            $export = new PaymentExport([Session::get('reports_data')]);
        }
        if (Session::get('reports_type') == 'clients') {
            $export = new AllUsers([Session::get('reports_data')]);
        }
        if (Session::get('reports_type') == 'mostselling') {
            $export = new MostSelling([Session::get('reports_data')]);
        }
        if (Session::get('reports_type') == 'abandoned_carts') {
            $export = new AbandonedCarts(Session::get('reports_data'));
        }
        session()->forget('data');
        session()->forget('type');

        return Excel::download($export, 'report- '.now().'.xlsx');
    }
}
