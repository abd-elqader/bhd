<?php

namespace App\Http\Controllers\Central\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\StoreFeatureHeaderRequest;
use App\Http\Requests\Central\Admin\UpdateFeatureHeaderRequest;
use App\Models\Central\FeatureHeader;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeatureHeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:package-headers-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:package-headers-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package-headers-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:package-headers-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $FeatureHeaders = FeatureHeader::latest();

            return Datatables::of($FeatureHeaders)
                ->addColumn('action', function ($FeatureHeader) {
                    return '<a style="color: #000;" href="'.route('admin.feature_headers.show', $FeatureHeader).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.feature_headers.edit', $FeatureHeader).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.feature_headers.destroy', $FeatureHeader).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->editColumn('status', function ($item) {
                    if ($item->status) {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'feature_headers\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'feature_headers\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Central.Admin.feature_headers.index');
    }

    public function create()
    {
        return view('Central.Admin.feature_headers.create');
    }

    public function store(StoreFeatureHeaderRequest $request)
    {
        FeatureHeader::create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(FeatureHeader $FeatureHeader)
    {
        return view('Central.Admin.feature_headers.show', compact('FeatureHeader'));
    }

    public function edit(FeatureHeader $FeatureHeader)
    {
        return view('Central.Admin.feature_headers.edit', compact('FeatureHeader'));
    }

    public function update(UpdateFeatureHeaderRequest $request, FeatureHeader $FeatureHeader)
    {
        $FeatureHeader->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(FeatureHeader $FeatureHeader)
    {
        $FeatureHeader->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
