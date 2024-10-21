<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllUsers implements FromView
{
    protected $users;

    public function __construct(array $users)
    {
        $this->users = $users[0];
    }

    public function view(): View
    {
        return view('Tenant.Admin.exports.allusers', [
            'users' => $this->users,
        ]);
    }
}
