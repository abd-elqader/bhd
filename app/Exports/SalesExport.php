<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
    protected $orders;

    public function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    public function view(): View
    {
        return view('Tenant.Admin.exports.SalesExport', [
            'orders' => $this->orders
        ]);
    }
}
