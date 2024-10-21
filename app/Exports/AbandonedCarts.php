<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbandonedCarts implements FromView
{
    protected $AbandonedCarts;

    public function __construct($AbandonedCarts)
    {
        $this->AbandonedCarts = $AbandonedCarts;
    }

    public function view(): View
    {
        return view('Tenant.Admin.exports.abandoned_carts', [
            'AbandonedCarts' => $this->AbandonedCarts,
        ]);
    }
}
