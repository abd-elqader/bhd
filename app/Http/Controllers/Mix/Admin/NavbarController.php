<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navbar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NavbarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:navbars-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:navbars-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:navbars-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:navbars-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $navbars = Navbar::latest();

            return DataTables::of($navbars)
                ->editColumn('status', function ($item) {
                    if ($item->status) {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'navbars\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'navbars\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('status')
                ->addIndexColumn()
                ->toJson();
        }

        return view('Mix.Admin.navbars.index');
    }
}
