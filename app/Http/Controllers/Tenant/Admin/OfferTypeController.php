<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreOfferTypeRequest;
use App\Http\Requests\Tenant\Admin\UpdateOfferTypeRequest;
use App\Models\Tenant\OfferType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfferTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:offertypes-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:offertypes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:offertypes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:offertypes-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $offertypes = OfferType::latest();
            if ($request->id) {
                $offertypes = $offertypes->where('id', $request->id);
            }

            return DataTables::of($offertypes)
                ->addColumn('action', function ($offertype) {
                    return '<a href="'.route('admin.offertypes.edit', $offertype).'"><i class="fa-solid fa-pen-to-square"></i></a>';
                })
                ->editColumn('status', function ($offertype) {
                    if ($offertype->status) {
                        return '<label data-id="'.$offertype->id.'" onclick="toggleswitch('.$offertype->id.',\'offer_type\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$offertype->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$offertype->id.'" onclick="toggleswitch('.$offertype->id.',\'offer_type\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$offertype->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('action', 'checkbox')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Tenant.Admin.offertypes.index');
    }

    public function create()
    {
        return view('Tenant.Admin.offertypes.create');
    }

    public function store(StoreOfferTypeRequest $request)
    {
        $OfferType = OfferType::latest()->create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(OfferType $OfferType)
    {
        return view('Tenant.Admin.offertypes.show', compact('OfferType'));
    }

    public function edit($id)
    {
        $OfferType = OfferType::find($id);

        return view('Tenant.Admin.offertypes.edit', compact('OfferType'));
    }

    public function update(UpdateOfferTypeRequest $request, OfferType $OfferType)
    {
        $OfferType->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(OfferType $OfferType)
    {
        $OfferType->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
