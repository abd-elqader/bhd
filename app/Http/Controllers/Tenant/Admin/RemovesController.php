<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreRemovesRequest;
use App\Http\Requests\Tenant\Admin\UpdateRemovesRequest;
use App\Models\Tenant\Removes;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RemovesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:removes-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:removes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:removes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:removes-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Removes = Removes::latest();

            return Datatables::of($Removes)
                ->addColumn('action', function ($Remove) {
                    return '<a style="color: #000;" href="'.route('admin.removes.edit', $Remove).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.removes.destroy', $Remove).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->editColumn('status', function ($Remove) {
                    if ($Remove->status) {
                        return '<label data-id="'.$Remove->id.'" onclick="toggleswitch('.$Remove->id.',\'removes\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Remove->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Remove->id.'" onclick="toggleswitch('.$Remove->id.',\'removes\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Remove->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('price', function ($Remove) {
                    return $Remove->price.' '.DefaultCurrancy()->currancy_code;
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.removes.index');
    }

    public function create()
    {
        return view('Tenant.Admin.removes.create');
    }

    public function store(StoreRemovesRequest $request)
    {
        Removes::create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Removes $Remove)
    {
        return view('Tenant.Admin.removes.show', compact('Remove'));
    }

    public function edit(Removes $Remove)
    {
        return view('Tenant.Admin.removes.edit', compact('Remove'));
    }

    public function update(UpdateRemovesRequest $request, Removes $Remove)
    {
        $Remove->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Removes $Remove)
    {
        $Remove->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
