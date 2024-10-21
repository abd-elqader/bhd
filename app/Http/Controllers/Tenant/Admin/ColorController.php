<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreColorRequest;
use App\Http\Requests\Tenant\Admin\UpdateColorRequest;
use App\Models\Tenant\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:colors-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:colors-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:colors-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:colors-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Color::latest();

            return DataTables::of($countries)
                ->addColumn('action', function ($Color) {
                    return '
                            <a href="'.route('admin.colors.edit', $Color).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" style="display: contents;" action="'.route('admin.colors.destroy', $Color).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>
                        ';
                })
                ->editColumn('status', function ($Color) {
                    if ($Color->status) {
                        return '<label data-id="'.$Color->id.'" onclick="toggleswitch('.$Color->id.',\'colors\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Color->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Color->id.'" onclick="toggleswitch('.$Color->id.',\'colors\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Color->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->editColumn('hexa', function ($Color) {
                    return '<span class="dot" style="background-color:'.$Color->hexa.'"></span>';
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Tenant.Admin.colors.index');
    }

    public function create()
    {
        return view('Tenant.Admin.colors.create');
    }

    public function store(StoreColorRequest $request)
    {
        Color::latest()->create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Color $Color)
    {
        return view('Tenant.Admin.colors.show', compact('Color'));
    }

    public function edit(Color $Color)
    {
        return view('Tenant.Admin.colors.edit', compact('Color'));
    }

    public function update(UpdateColorRequest $request, Color $Color)
    {
        $Color->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Color $Color)
    {
        $Color->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
