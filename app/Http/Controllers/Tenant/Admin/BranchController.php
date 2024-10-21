<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreBranchRequest;
use App\Http\Requests\Tenant\Admin\UpdateBranchRequest;
use App\Models\Country;
use App\Models\Region;
use App\Models\Tenant\Branch;
use App\Models\Tenant\BranchRegion;
use App\Models\Tenant\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:branches-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:branches-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:branches-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:branches-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Branchs = Branch::latest();
            if ($request->country_id) {
                $Branchs = $Branchs->where('country_id', $request->country_id);
            }

            return Datatables::of($Branchs)
                ->addColumn('action', function ($Branch) {
                    return '<a style="color: #000;" href="'.route('admin.branches.show', $Branch).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.branches.edit', $Branch).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.branches.destroy', $Branch).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->editColumn('status', function ($Branch) {
                    if ($Branch->status) {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Branch->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Branch->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('delivery', function ($Branch) {
                    if ($Branch->delivery) {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\',\'delivery\',\'delivery-checkbox\')" class="switch toggleswitch bg-dark"><input id="delivery-checkbox'.$Branch->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\',\'delivery\',\'delivery-checkbox\')" class="switch toggleswitch bg-dark"><input id="delivery-checkbox'.$Branch->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('pickup', function ($Branch) {
                    if ($Branch->pickup) {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\',\'pickup\',\'pickup-checkbox\')" class="switch toggleswitch bg-dark"><input id="pickup-checkbox'.$Branch->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\',\'pickup\',\'pickup-checkbox\')" class="switch toggleswitch bg-dark"><input id="pickup-checkbox'.$Branch->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('dinein', function ($Branch) {
                    if ($Branch->dinein) {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\',\'dinein\',\'dinein-checkbox\')" class="switch toggleswitch bg-dark"><input id="dinein-checkbox'.$Branch->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Branch->id.'" onclick="toggleswitch('.$Branch->id.',\'branches\',\'dinein\',\'dinein-checkbox\')" class="switch toggleswitch bg-dark"><input id="dinein-checkbox'.$Branch->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('country_id', function ($Branch) {
                    return '<a style="color: blue;" href="'.route('admin.countries.show', ['country' => $Branch->Country ? $Branch->Country['id'] : 1]).'">'.mb_strimwidth($Branch->Country ? $Branch->Country->title() : null, 0, 50, '...').'</a>';
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.branchs.index');
    }

    public function create()
    {
        $countries = Country::get();
        return view('Tenant.Admin.branchs.create', compact('countries'));
    }

    public function store(StoreBranchRequest $request)
    {
        $Branch = Branch::create($request->only('country_id', 'title_ar', 'title_en', 'phone', 'whatsapp', 'email', 'address_ar', 'address_en', 'working_time_ar', 'working_time_en', 'delivery', 'pickup', 'dinein', 'status', 'lat', 'long', 'block', 'road', 'building_no', 'floor_no', 'apartment'));
        if ($request->open && $request->close && count($request->open) == count($request->open)) {
            foreach ($request->open as $key => $val) {
                $Branch->WorkTime()->create([
                    'open' => $request->open[$key],
                    'close' => $request->close[$key],
                ]);
            }
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Branch $Branch)
    {
        return view('Tenant.Admin.branchs.show', compact('Branch'));
    }

    public function edit(Branch $Branch)
    {
        $countries = Country::get();
        return view('Tenant.Admin.branchs.edit', compact('Branch', 'countries'));
    }

    public function update(UpdateBranchRequest $request, Branch $Branch)
    {
        $Branch->update($request->only('country_id', 'title_ar', 'title_en', 'phone', 'whatsapp', 'email', 'address_ar', 'address_en', 'working_time_ar', 'working_time_en', 'delivery', 'pickup', 'dinein', 'status', 'lat', 'long', 'block', 'road', 'building_no', 'floor_no', 'apartment'));
        if ($request->images && count($request->images)) {
            foreach ($request->images as $img) {
                $Branch->Images()->create([
                    'image' => Upload::UploadFile($img, 'Branches'),
                ]);
            }
        }
        if ($request->open && $request->close && count($request->open) == count($request->open)) {
            $Branch->WorkTime()->delete();
            foreach ($request->open as $key => $val) {
                $Branch->WorkTime()->create([
                    'open' => $request->open[$key],
                    'close' => $request->close[$key],
                ]);
            }
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Branch $Branch)
    {
        $Branch->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
