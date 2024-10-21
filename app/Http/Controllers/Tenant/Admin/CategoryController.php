<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreCategoryRequest;
use App\Http\Requests\Tenant\Admin\UpdateCategoryRequest;
use App\Models\Tenant\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Category::latest();

            return DataTables::of($countries)
                ->addColumn('action', function ($item) {
                    return '<a href="'.route('admin.categories.show', $item).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.categories.edit', $item).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.categories.destroy', $item).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->addColumn('image', function ($item) {
                    return blank($item['image']) ? '<img style="height: 100px" src="'. setting('logo') .'" alt="IMG" width="150">' : '<img style="height: 100px" src="'.$item['image'].'" alt="IMG" width="150">';
                })
                ->editColumn('status', function ($item) {
                    if ($item->status) {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'categories\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'categories\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Tenant.Admin.categories.index');
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return view('Tenant.Admin.categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $Category = Category::latest()->create(['image' => Upload::UploadFile($request['image'], 'countries')] + $request->validated());
        } else {
            $Category = Category::latest()->create($request->validated());
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Category $Category)
    {
        return view('Tenant.Admin.categories.show', compact('Category'));
    }

    public function edit(Category $Category)
    {
        $categories = Category::latest()->get();

        return view('Tenant.Admin.categories.edit', compact('categories', 'Category'));
    }

    public function update(UpdateCategoryRequest $request, Category $Category)
    {
        if ($request->hasFile('image')) {
            $Category->update(['image' => Upload::UploadFile($request['image'], 'countries')] + $request->validated());
        } else {
            $Category->update($request->validated());
        }

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Category $Category)
    {
        $Category->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
