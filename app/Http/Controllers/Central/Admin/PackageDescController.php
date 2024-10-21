<?php

namespace App\Http\Controllers\Central\Admin;

use App\Http\Controllers\Controller;
use App\Models\Central\PackageDesc;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackageDescController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:package_descs-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:package_descs-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package_descs-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:package_descs-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $PackageDesc_descs = PackageDesc::latest();

            return Datatables::of($PackageDesc_descs)
                ->addColumn('action', function ($PackageDesc) {
                    return '
                            <a style="color: #000;" href="'.route('admin.package_descs.edit', $PackageDesc).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.package_descs.destroy', $PackageDesc).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Central.Admin.package_descs.index');
    }

    public function create()
    {
        return view('Central.Admin.package_descs.create');
    }

    public function store(Request $request)
    {
        $PackageDesc = PackageDesc::create($request->only('title_ar', 'title_en'));

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(PackageDesc  $PackageDesc)
    {
        return view('Central.Admin.package_descs.show');
    }

    public function edit(PackageDesc  $PackageDesc)
    {
        return view('Central.Admin.package_descs.edit', compact('PackageDesc'));
    }

    public function update(Request $request, PackageDesc  $PackageDesc)
    {
        $PackageDesc->update($request->only('title_ar', 'title_en'));
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(PackageDesc  $PackageDesc)
    {
        $PackageDesc->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
