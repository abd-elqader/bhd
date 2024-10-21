<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreSizeRequest;
use App\Http\Requests\Tenant\Admin\UpdateSizeRequest;
use App\Models\Tenant\Size;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sizes-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:sizes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sizes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:sizes-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Size::latest();

            return DataTables::of($countries)
                ->addColumn('action', function ($Size) {
                    return '
                            <a href="'.route('admin.sizes.edit', $Size).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" style="display: contents;" action="'.route('admin.sizes.destroy', $Size).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>
                        ';
                })
                ->editColumn('status', function ($Size) {
                    if ($Size->status) {
                        return '<label data-id="'.$Size->id.'" onclick="toggleswitch('.$Size->id.',\'sizes\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Size->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Size->id.'" onclick="toggleswitch('.$Size->id.',\'sizes\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Size->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.sizes.index');
    }

    public function create()
    {
        return view('Tenant.Admin.sizes.create');
    }

    public function store(StoreSizeRequest $request)
    {
        Size::latest()->create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Size $Size)
    {
        return view('Tenant.Admin.sizes.show', compact('Size'));
    }

    public function edit(Size $Size)
    {
        return view('Tenant.Admin.sizes.edit', compact('Size'));
    }

    public function update(UpdateSizeRequest $request, Size $Size)
    {
        $Size->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Size $Size)
    {
        if($size->id == 20){
            alert()->success('this size cannot be deleted');
            return redirect()->back();
        }
        $Size->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
