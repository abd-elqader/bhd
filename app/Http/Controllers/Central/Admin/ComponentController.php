<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\StoreComponentRequest;
use App\Http\Requests\Central\Admin\UpdateComponentRequest;
use App\Models\Central\Component;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ComponentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:components-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:components-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:components-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:components-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Components = Component::orderBy('type')->orderBy('title_en')->latest();

            return DataTables::of($Components)
                ->addColumn('action', function ($Component) {
                    return '<form class="formDelete" method="POST" action="'.route('admin.components.destroy', $Component).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->editColumn('preview', function ($Component) {
                    return '<a target="_blanck" href="'.route('previewComponent', $Component->id).'">Preview</a>';
                })
                ->escapeColumns('action', 'checkbox', 'preview')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Central.Admin.components.index');
    }

    public function create()
    {
        abort(404);

        return view('Central.Admin.components.create');
    }

    public function store(StoreComponentRequest $request)
    {
        abort(404);
        Component::create(['preview' => Upload::UploadFile($request->preview, 'previews')] + $request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Component $Component)
    {
        abort(404);

        return view('Central.Admin.components.show', compact('Component'));
    }

    public function edit(Component $Component)
    {
        abort(404);

        return view('Central.Admin.components.edit', compact('Component'));
    }

    public function update(UpdateComponentRequest $request, Component $Component)
    {
        abort(404);
        if ($request->preview) {
            $Component->update(['preview' => Upload::UploadFile($request->preview, 'previews')] + $request->validated());
        } else {
            $Component->update($request->validated());
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Component $Component)
    {
        $Component->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function previewComponent($id)
    {
        $data = Component::find($id);

        return view('Central.Admin.components.preview', compact('data'));
    }
}
