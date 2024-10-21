<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Models\Central\Blog;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:blogs-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:blogs-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:blogs-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:blogs-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $blogs = Blog::latest();

            return DataTables::of($blogs)
                ->addColumn('action', function ($blog) {
                    return '<a style="color: #000;" href="'.route('admin.blogs.show', $blog).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.blogs.edit', $blog).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.blogs.destroy', $blog).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->addColumn('image', function ($blog) {
                    return '<img style="height: 100px" src="'.$blog->image.'" alt="IMG" width="150">';
                })
                ->editColumn('status', function ($Model) {
                    if ($Model->status) {
                        return '<label data-id="'.$Model->id.'" onclick="toggleswitch('.$Model->id.',\'blogs\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Model->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Model->id.'" onclick="toggleswitch('.$Model->id.',\'blogs\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Model->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($blog) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$blog->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status', 'image')
                ->make(true);
        }

        return view('Central.Admin.blogs.index');
    }

    public function create()
    {
        return view('Central.Admin.blogs.create');
    }

    public function store(Request $request)
    {
        // dd(json_encode(array_values($request['attachment-blog-trixFields'])));

        $id = Blog::insertGetId([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'short_desc_ar' => $request->short_desc_ar,
            'short_desc_en' => $request->short_desc_en,
            'status' => $request->status,
            'blog-trixFields' => json_encode($request['blog-trixFields']),
            'attachment-blog-trixFields' => json_encode(array_values($request['attachment-blog-trixFields'])),
            'long_desc_en' => $request['blog-trixFields']['long_desc_en'],
            'long_desc_ar' => $request['blog-trixFields']['long_desc_ar'],
            'image' => '',
        ]);

        $blog = Blog::find($id);

        if ($request->hasFile('image')) {
            $blog->image = Upload::UploadFile($request->image, 'Blogs');
        }
        $blog->save();

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function update(Request $request, Blog $blog)
    {
        $blog->title_ar = $request->title_ar;
        $blog->title_en = $request->title_en;
        $blog->short_desc_ar = $request->short_desc_ar;
        $blog->short_desc_en = $request->short_desc_en;
        $blog->status = $request->status;
        $blog['blog-trixFields'] = json_encode($request['blog-trixFields']);
        $blog['attachment-blog-trixFields'] = json_encode(array_values($request['attachment-blog-trixFields']));
        $blog->long_desc_en = $request['blog-trixFields']['long_desc_en'];
        $blog->long_desc_ar = $request['blog-trixFields']['long_desc_ar'];

        if ($request->hasFile('image')) {
            Upload::deleteImage($blog->image);
            $blog->image = Upload::UploadFile($request->image, 'Blogs');
        }
        $blog->save();

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function uploadImages(Request $request)
    {
        // $href = Upload::UploadFile($request->file, 'BlogImages');
        // // dd(response()->json([
        // //     'href' => $href,
        // // ]));
        // return ['href' => $href];
    }

    public function show(Blog $blog)
    {
        return view('Central.Admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Upload::deleteImage($blog->image);
        }

        $blog->delete();

        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function edit(Blog $blog)
    {
        return view('Central.Admin.blogs.edit', compact('blog'));
    }
}
