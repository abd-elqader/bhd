<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreImageTypeRequest;
use App\Http\Requests\Mix\Admin\UpdateImageTypeRequest;
use App\Models\ImageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ImageTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:imagetypes-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:imagetypes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:imagetypes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:imagetypes-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imagetypes = ImageType::latest();

            return DataTables::of($imagetypes)
                ->addColumn('action', function ($ImageType) {
                    return '<a href="'.route('admin.imagetypes.show', $ImageType).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.imagetypes.edit', $ImageType).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.imagetypes.destroy', $ImageType).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->editColumn('status', function ($ImageType) {
                    if ($ImageType->status) {
                        return '<label data-id="'.$ImageType->id.'" onclick="toggleswitch('.$ImageType->id.',\'image_types")"  class="switch toggleswitch bg-dark"><input id="checkbox'.$ImageType->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$ImageType->id.'" onclick="toggleswitch('.$ImageType->id.',\'image_types")"  class="switch toggleswitch bg-dark"><input id="checkbox'.$ImageType->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Mix.Admin.imagetypes.index');
    }

    public function create()
    {
        return view('Mix.Admin.imagetypes.create');
    }

    public function store(StoreImageTypeRequest $request)
    {
        ImageType::latest()->create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));
        Session::forget('Types');

        return redirect()->back();
    }

    public function show($id)
    {
        $ImageType = ImageType::where('id', $id)->first();
        dd($ImageType);

        return view('Mix.Admin.imagetypes.show', compact('ImageType'));
    }

    public function edit($id)
    {
        $ImageType = ImageType::where('id', $id)->first();

        return view('Mix.Admin.imagetypes.edit', compact('ImageType'));
    }

    public function update(UpdateImageTypeRequest $request, $id)
    {
        $ImageType = ImageType::where('id', $id)->first();
        $ImageType->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $ImageType = ImageType::where('id', $id)->first();
        $ImageType->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
