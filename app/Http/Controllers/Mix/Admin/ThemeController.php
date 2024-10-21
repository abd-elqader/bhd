<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Models\Central\DefaultTheme;
use App\Models\Theme;
use App\Models\ThemePage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:themes-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:themes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:themes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:themes-delete', ['only' => ['destroy']]);
    }

    public function defaultIndex(Request $request)
    {
        if ($request->ajax()) {
            $themes = DefaultTheme::latest();

            return DataTables::of($themes)
                ->addColumn('action', function ($Theme) {
                    return '<a target="_blank" href="'.route('admin.fullDefaultTheme', $Theme->id).'"><i class="fa-solid fa-eye"></i></a>';
                })
                ->addColumn('name', function ($Theme) {
                    return $Theme->title();
                })
                ->addColumn('image', function ($Theme) {
                    return '<img style="width:100px;" src="'.$Theme->image.'" alt="img">';
                })
                ->escapeColumns(['action', 'name', 'image'])
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->rawColumns(['image', 'action'])
                ->toJson();
        }

        return view('Mix.Admin.themes.index');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $themes = Theme::latest();

            return DataTables::of($themes)
                ->addColumn('action', function ($Theme) {
                    return '<a href="'.route('admin.fullTheme', $Theme->id).'"><i class="fa-solid fa-eye"></i></a>
                            <a href="'.route('admin.themes.edit', $Theme->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.themes.destroy', $Theme->id).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->addColumn('name', function ($Theme) {
                    return $Theme->title();
                })
                ->addColumn('image', function ($Theme) {
                    return '<img style="width:100px;" src="'.$Theme->image.'" alt="img">';
                })
                ->escapeColumns(['action', 'name', 'image'])
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->rawColumns(['image', 'action'])
                ->toJson();
        }

        return view('Mix.Admin.themes.index');
    }

    public function create()
    {
        $ThemePages = ThemePage::get();

        return view('Mix.Admin.themes.create', compact('ThemePages'));
    }

    public function store(Request $request)
    {
        $theme = Theme::create(['title_ar' => $request->title_ar, 'title_en' => $request->title_en]);

        if ($request->hasFile('image')) {
            $theme->image = Upload::UploadFile($request->image, 'Themes');
        }

        foreach ($request->themePages as $item) {
            $theme->themePages()->attach($item);
        }

        $theme->save();

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function edit($id)
    {
        $ThemePages = ThemePage::get();
        $Theme = Theme::find($id);

        return view('Mix.Admin.themes.edit', compact(['Theme', 'ThemePages']));
    }

    public function update(Request $request, $id)
    {
        $theme = Theme::find($id);

        $theme->update(['title_ar' => $request->title_ar, 'title_en' => $request->title_en]);

        if ($request->hasFile('image')) {
            if ($theme->image) {
                Upload::deleteImage($theme->image);
            }
            $theme->image = Upload::UploadFile($request->image, 'Themes');
        }

        $theme->themePages()->sync($request->themePages);

        $theme->save();

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        Theme::find($id)->delete();

        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function previewTheme(Request $request)
    {
        //view components while creating a page
        $data = [];

        $themePage = ThemePage::whereIn('id', explode(',', $request->ids))->get();

        foreach ($themePage->sortBy('order') as $key => $page) {
            $data[$key]['name'] = $page->title();
            foreach ($page->tenantComponents as $item) {
                $data[$key][] = $item;
            }
        }

        return view('Mix.Admin.themes.fullThemePreview', compact('data'));
    }

    public function previewFullTheme($id)
    {
        //view full theme pages of theme

        $theme = Theme::find($id);

        $data = [];

        foreach ($theme->themePages->sortBy('order') as $key => $page) {
            $data[$key]['name'] = $page->title();
            foreach ($page->tenantComponents as $item) {
                $data[$key][] = $item;
            }
        }

        return view('Mix.Admin.themes.fullThemePreview', compact('data'));
    }

    public function fullTheme($id)
    {
        $theme = Theme::find($id);
        $type = '';

        return view('Mix.Admin.theme_preview', compact('theme', 'type'));
    }
}
