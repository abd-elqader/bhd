<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreImageRequest;
use App\Http\Requests\Mix\Admin\UpdateImageRequest;
use App\Models\Image;
use App\Models\ImageType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ImagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:images-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:images-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:images-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:images-delete', ['only' => ['destroy']]);
    }

    public function index($type = null,Request $request)
    {
        $Image_Type = ImageType::where('id', $type)->firstOrFail();
        $Models = Image::latest()->when($type, function ($query) use($type) {
            return $query->where('type_id', $type);
        })->get();

        return view('Mix.Admin.images.index', compact('Image_Type','Models'));
    }

    public function create($type = null,Request $request)
    {
        $Image_Type = null;
        $Types = collect();
        if ($type) {
            $Image_Type = ImageType::where('id', $type)->firstOrFail();
        } else {
            $Types = ImageType::all();
        }

        return view('Mix.Admin.images.create', compact('Types', 'Image_Type'));
    }

    public function store($type = null,StoreImageRequest $request)
    {
        Image::latest()->create(['image' => Upload::UploadFile($request['image'], 'Images')] + $request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($type = null,$id)
    {
        $Image = Image::latest()->findOrFail($id);
        return view('Mix.Admin.images.show', compact('Image'));
    }

    public function edit($type = null,$id, Request $request)
    {
        $Image = Image::latest()->findOrFail($id);
        $Image_Type = null;
        $Types = collect();
        if ($type) {
            $Image_Type = ImageType::where('id', $type)->firstOrFail();
        } else {
            $Types = ImageType::all();
        }

        return view('Mix.Admin.images.edit', compact('Image', 'Types', 'Image_Type'));
    }

    public function update($type = null,UpdateImageRequest $request, $id)
    {
        $Image = Image::latest()->findOrFail($id);
        if ($request->hasFile('image')) {
            Upload::deleteImage($Image->image);
            $Image->update(['image' => Upload::UploadFile($request['image'], 'Images')] + $request->validated());
        } else {
            $Image->update($request->validated());
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($type = null,$id)
    {
        Image::latest()->where('id', $id)->forcedelete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
