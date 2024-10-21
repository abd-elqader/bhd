<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreDelivryRequest;
use App\Http\Requests\Tenant\Admin\UpdateDelivryRequest;
use App\Models\Tenant\Delivry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DelivryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deliveries-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:deliveries-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:deliveries-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deliveries-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $delivrys = Delivry::latest();

            return Datatables::of($delivrys)
                ->addColumn('action', function ($delivry) {
                    return '<a style="color: #000;" href="'.route('admin.deliveries.edit', $delivry).'"><i class="fa-solid fa-pen-to-square"></i></a>';
                })
                ->editColumn('status', function ($delivry) {
                    if ($delivry->status) {
                        return '<label data-id="'.$delivry->id.'" onclick="toggleswitch('.$delivry->id.',\'delivries\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$delivry->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$delivry->id.'" onclick="toggleswitch('.$delivry->id.',\'delivries\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$delivry->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.deliveries.index');
    }

    public function create()
    {
        return view('Tenant.Admin.deliveries.create');
    }

    public function store(StoreDelivryRequest $request)
    {
        Delivry::create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Delivry = Delivry::find($id);

        return view('Tenant.Admin.deliveries.show', compact('Delivry'));
    }

    public function edit($id)
    {
        $Delivry = Delivry::find($id);

        return view('Tenant.Admin.deliveries.edit', compact('Delivry'));
    }

    public function update(UpdateDelivryRequest $request, $id)
    {
        $Delivry = Delivry::find($id);
        $Delivry->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Delivry = Delivry::find($id);
        $Delivry->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
