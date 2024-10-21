<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\StoreStoresRequest;
use App\Http\Requests\Central\Admin\UpdateStoresRequest;
use App\Models\Central\Stores;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:stores-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:stores-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stores-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:stores-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Models = Stores::latest();
            if ($request->type) {
                $Models = $Models->where('type_id', $request->type);
            }

            return DataTables::of($Models)
                ->addColumn('action', function ($Model) {
                    return '<a href="'.route('admin.stores.show', $Model).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.stores.edit', $Model).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.stores.destroy', $Model).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->addColumn('image', function ($Model) {
                    return '<img style="height: 100px" src="'.$Model['image'].'" alt="IMG" width="150">';
                })

                ->editColumn('status', function ($Model) {
                    if ($Model->status) {
                        return '<label data-id="'.$Model->id.'" onclick="toggleswitch('.$Model->id.',\'stores\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Model->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Model->id.'" onclick="toggleswitch('.$Model->id.',\'stores\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Model->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Central.Admin.stores.index');
    }

    public function create(Request $request)
    {
        return view('Central.Admin.stores.create');
    }

    public function store(StoreStoresRequest $request)
    {
        Stores::latest()->create([
            'website' => Upload::UploadFile($request['website'], 'Stores'),
            'image' => Upload::UploadFile($request['image'], 'Stores'),
        ] + $request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Store = Stores::latest()->findOrFail($id);
        return view('Central.Admin.stores.show', compact('Store'));
    }

    public function edit($id, Request $request)
    {
        $Store = Stores::latest()->findOrFail($id);

        return view('Central.Admin.stores.edit', compact('Store'));
    }

    public function update(UpdateStoresRequest $request, $id)
    {
        $Store = Stores::latest()->findOrFail($id);
        if ($request->hasFile('image') && $request->hasFile('website')) {
            Upload::deleteImage($Store->image);
            $Store->update([
                'website' => Upload::UploadFile($request['image'], 'Stores'),
                'image' => Upload::UploadFile($request['image'], 'Stores'),
            ] + $request->validated());
        } elseif ($request->hasFile('image')) {
            Upload::deleteImage($Store->image);
            $Store->update([
                'image' => Upload::UploadFile($request['image'], 'Stores'),
            ] + $request->validated());
        } elseif ($request->hasFile('website')) {
            Upload::deleteImage($Store->image);
            $Store->update([
                'image' => Upload::UploadFile($request['image'], 'Stores'),
            ] + $request->validated());
        } else {
            $Store->update($request->validated());
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        Stores::latest()->where('id', $id)->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
