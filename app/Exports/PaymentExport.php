<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{
    protected $orders;

    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    public function view(): View
    {
        return view('Tenant.Admin.exports.PaymentExport', [
            'orders' => $this->orders,
        ]);
    }
}
