<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreCouponRequest;
use App\Http\Requests\Tenant\Admin\UpdateCouponRequest;
use App\Models\Tenant\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:coupons-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:coupons-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:coupons-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:coupons-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Coupon::latest();

            return DataTables::of($countries)
                ->addColumn('action', function ($Coupon) {
                    return '
                            <a href="'.route('admin.coupons.edit', $Coupon).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" style="display: contents;" action="'.route('admin.coupons.destroy', $Coupon).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>
                        ';
                })
                ->editColumn('percent_off', function ($Coupon) {
                    return blank($Coupon['percent_off']) ? '' : $Coupon['percent_off'].' %';
                })
                ->editColumn('discount', function ($Coupon) {
                    return blank($Coupon['discount']) ? '' : $Coupon['discount'].' BD';
                })
                ->editColumn('type', function ($Coupon) {
                    return $Coupon['type'] == 'discount' ? __('messages.fixedprice') : __('messages.Discount Percentage');
                })
                ->editColumn('status', function ($Coupon) {
                    if ($Coupon->status) {
                        return '<label data-id="'.$Coupon->id.'" onclick="toggleswitch('.$Coupon->id.',\'coupons\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Coupon->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Coupon->id.'" onclick="toggleswitch('.$Coupon->id.',\'coupons\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Coupon->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.coupons.index');
    }

    public function create()
    {
        return view('Tenant.Admin.coupons.create');
    }

    public function store(StoreCouponRequest $request)
    {
        Coupon::latest()->create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Coupon $Coupon)
    {
        return view('Tenant.Admin.coupons.show', compact('Coupon'));
    }

    public function edit(Coupon $Coupon)
    {
        return view('Tenant.Admin.coupons.edit', compact('Coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $Coupon)
    {
        $Coupon->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Coupon $Coupon)
    {
        $Coupon->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
