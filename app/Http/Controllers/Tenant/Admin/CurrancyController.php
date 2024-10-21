<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreCurrancyRequest;
use App\Http\Requests\Tenant\Admin\UpdateCurrancyRequest;
use App\Models\Tenant\Currancy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CurrancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:currancies-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:currancies-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:currancies-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:currancies-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Currancies = Currancy::latest();

            return DataTables::of($Currancies)
                ->addColumn('action', function ($Currancy) {
                    return '<a href="'.route('admin.currencies.show', $Currancy).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.currencies.edit', $Currancy).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.currencies.destroy', $Currancy).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->editColumn('status', function ($Currancy) {
                    if ($Currancy->status) {
                        return '<label data-id="'.$Currancy->id.'" onclick="toggleswitch('.$Currancy->id.',\'currencies\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Currancy->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Currancy->id.'" onclick="toggleswitch('.$Currancy->id.',\'currencies\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Currancy->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Tenant.Admin.currancies.index');
    }

    public function create()
    {
        return view('Tenant.Admin.currancies.create');
    }

    public function store(StoreCurrancyRequest $request)
    {
        if ($request->hasFile('image')) {
            $Currancy = Currancy::latest()->create(['image' => Upload::UploadFile($request['image'], 'currancies')] + $request->validated());
        } else {
            $Currancy = Currancy::latest()->create($request->validated());
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Currancy = Currancy::latest()->findOrFail($id);

        return view('Tenant.Admin.currancies.show', compact('Currancy'));
    }

    public function edit($id)
    {
        $Currancy = Currancy::latest()->findOrFail($id);

        return view('Tenant.Admin.currancies.edit', compact('Currancy'));
    }

    public function update(UpdateCurrancyRequest $request, $id)
    {
        $Currancy = Currancy::latest()->findOrFail($id);
        if ($request->hasFile('image')) {
            $Currancy->update(['image' => Upload::UploadFile($request['image'], 'currancies')] + $request->validated());
        } else {
            $Currancy->update($request->validated());
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Currancy = Currancy::latest()->findOrFail($id);
        $Currancy->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function switch()
    {
        $Currancy = Currancy::latest()->findOrFail(request('id'));
        $Currancy->status = request('status');
        $Currancy->save();
    }
}
