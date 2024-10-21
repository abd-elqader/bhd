<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant\Weight;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MobileController extends Controller
{
    public function index(Request $request)
    {

        return view('Tenant.Admin.mobile-app.index');
    }
}
