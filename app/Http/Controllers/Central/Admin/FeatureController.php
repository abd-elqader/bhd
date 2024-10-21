<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\StoreFeatureRequest;
use App\Http\Requests\Central\Admin\UpdateFeatureRequest;
use App\Models\Central\Feature;
use App\Models\Central\FeatureHeader;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:package-features-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:package-features-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:package-features-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:package-features-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Features = Feature::latest();

            return Datatables::of($Features)
                ->addColumn('action', function ($Feature) {
                    return '
                            <a style="color: #000;" href="'.route('admin.features.edit', $Feature).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.features.destroy', $Feature).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->addColumn('image', function ($Image) {
                    if ($Image['image']) {
                        return '<img style="height: 100px" src="'.$Image['image'].'" alt="IMG" width="150">';
                    }

                    return '';
                })
                ->addColumn('header_id', function ($Image) {
                    return $Image->Header->title();
                })
                ->addColumn('type', function ($Image) {
                    return __('messages.'.$Image->type);
                })

                ->editColumn('status', function ($item) {
                    if ($item->status) {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'features\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'features\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Central.Admin.features.index');
    }

    public function create()
    {
        $heads = FeatureHeader::get();

        return view('Central.Admin.features.create', compact('heads'));
    }

    public function store(StoreFeatureRequest $request)
    {
        $Feature = Feature::create($request->validated());
        if ($request->hasFile('image')) {
            $Feature->image = Upload::UploadFile($request->image, 'Features');
        }
        $Feature->save();
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Feature $Feature)
    {
        return view('Central.Admin.features.show', compact('Feature'));
    }

    public function edit(Feature $Feature)
    {
        $heads = FeatureHeader::get();

        return view('Central.Admin.features.edit', compact('Feature', 'heads'));
    }

    public function update(UpdateFeatureRequest $request, Feature $Feature)
    {
        $Feature->update($request->validated());
        if ($request->hasFile('image')) {
            $Feature->image = Upload::UploadFile($request->image, 'Features');
        }
        $Feature->save();
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Feature $Feature)
    {
        $Feature->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
