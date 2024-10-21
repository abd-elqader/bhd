<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreAdditionsRequest;
use App\Http\Requests\Tenant\Admin\UpdateAdditionsRequest;
use App\Models\Tenant\Additions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdditionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:additions-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:additions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:additions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:additions-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Additions = Additions::latest();

            return Datatables::of($Additions)
                ->addColumn('action', function ($Addition) {
                    return '<a style="color: #000;" href="'.route('admin.additions.show', $Addition).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.additions.edit', $Addition).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.additions.destroy', $Addition).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->editColumn('status', function ($Addition) {
                    if ($Addition->status) {
                        return '<label data-id="'.$Addition->id.'" onclick="toggleswitch('.$Addition->id.',\'additions\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Addition->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Addition->id.'" onclick="toggleswitch('.$Addition->id.',\'additions\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Addition->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('price', function ($Addition) {
                    return $Addition->price.' '.DefaultCurrancy()->currancy_code;
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.additions.index');
    }

    public function create()
    {
        return view('Tenant.Admin.additions.create');
    }

    public function store(StoreAdditionsRequest $request)
    {
        Additions::create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Additions $Addition)
    {
        return view('Tenant.Admin.additions.show', compact('Additions'));
    }

    public function edit(Additions $Addition)
    {
        return view('Tenant.Admin.additions.edit', compact('Additions'));
    }

    public function update(UpdateAdditionsRequest $request, Additions $Addition)
    {
        $Addition->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Additions $Addition)
    {
        $Addition->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
