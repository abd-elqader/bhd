<?php

namespace App\Http\Controllers\Central\Admin;

use App\Exports\AllUsers;
use App\Exports\ClientExport;
use App\Exports\SalesExport;
use App\Exports\FinancialExport;
use App\Exports\MostSelling;
use App\Exports\PaymentExport;
use App\Exports\Test;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Tenant\Order;
use App\Models\Tenant\OrderProduct;
use App\Models\Tenant\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function reports()
    {
        $AllTenants = \App\Models\Tenant::get();
        $Deliveries = \App\Models\Central\Delivery::get();
        $Tenants = $AllTenants->when(request('tenant'), function ($query) {
                        return $query->where('id',  request('tenant'));
                    });
        foreach($Tenants as $Tenant){
                $this->ChangeConnection($Tenant->id);
                $Tenant->Orders = Order::where('status', 1)->whereIn('follow', [3])
                    ->when(request('from'), function ($query) {
                        return $query->whereDate('created_at', '>=', request('from'));
                    })
                    ->when(request('to'), function ($query) {
                        return $query->whereDate('created_at', '<=', request('to'));
                    })
                    ->when(request('delivery_company_id'), function ($query) {
                        return $query->where('delivery_company_id', request('delivery_company_id'));
                    })
                ->get();   
            
        }
        return view('Central.Admin.ShopSales', compact('Tenants','AllTenants','Deliveries'));
    }
    
    public function ChangeConnection($shop = null)
    {
        if($shop){
            session()->put('reports_shop' , $shop);
        }elseif(request('shop')){
            session()->put('reports_shop' , request('shop'));
        }
        \Config::set("database.connections.mysql", [
            "driver" => 'mysql',
            "host" => env('DB_HOST'),
            "database" => 'matjrbh_' . session()->get('reports_shop'),
            "username" => env('DB_USERNAME'),
            "password" => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);
        DB::purge('mysql');
        DB::reconnect('mysql');
    }
    
    public function sales()
    {
        $this->ChangeConnection();
        $orders = [];
        $orders = Order::where('status', 1)->whereIn('follow', [3])
        ->when(request('from'), function ($query) {
            return $query->whereDate('created_at', '>=', request('from'));
        })
        ->when(request('to'), function ($query) {
            return $query->whereDate('created_at', '<=', request('to'));
        })
        ->get();

        Session::put('reports_data', $orders);
        Session::put('reports_type', 'sales');
        return view('Tenant.Admin.report.sales', compact('orders'));
    }
    
    public function financial()
    {
        $this->ChangeConnection();
        $orders = [];
        $orders = Order::where('status', 1)->whereIn('follow', [3])
        ->when(request('from'), function ($query) {
            return $query->whereDate('created_at', '>=', request('from'));
        })
        ->when(request('to'), function ($query) {
            return $query->whereDate('created_at', '<=', request('to'));
        })
        ->get();
        
        Session::put('reports_data', $orders);
        Session::put('reports_type', 'financial');

        return view('Tenant.Admin.report.financial', compact('orders'));
    }

    public function client()
    {
        $this->ChangeConnection();
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
        $this->ChangeConnection();
        $reports = [];
            $reports = Transaction::query()
            ->when(request('from'), function ($query) {
                return $query->whereDate('created_at', '>=', request('from'));
            })
            ->when(request('to'), function ($query) {
                return $query->whereDate('created_at', '<=', request('to'));
            })
            ->get();
        
        Session::put('reports_data', $reports);
        Session::put('reports_type', 'payment');

        return view('Tenant.Admin.report.payment', compact('reports'));
    }

    public function mostselling()
    {
        $this->ChangeConnection();
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
        $this->ChangeConnection();
        $Orders = Order::where('status', 1)->whereIn('follow', [3])
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
        session()->forget('data');
        session()->forget('type');

        return Excel::download($export, 'report- '.now().'.xlsx');
    }
}
