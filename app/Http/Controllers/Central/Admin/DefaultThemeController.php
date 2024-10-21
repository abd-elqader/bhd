<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Models\Central\DefaultTheme;
use App\Models\Central\DefaultThemePage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DefaultThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:themes-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:themes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:themes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:themes-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $themes = DefaultTheme::latest();

            return DataTables::of($themes)
                ->addColumn('action', function ($Theme) {
                    return '<a target="_blank" href="'.route('admin.fullDefaultTheme', $Theme->id).'"><i class="fa-solid fa-eye"></i></a>
                            <a href="'.route('admin.default_themes.edit', $Theme->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.default_themes.destroy', $Theme->id).'">
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
          
               ->addColumn('image', function ($Model) {
                   if($Model->image){                       
                        return '<a class="image-popup-no-margins" href="' . public_asset($Model->image) . '">
                            <img src="' . public_asset($Model->image) . '" style="max-height: 150px;max-width: 150px">
                        </a>';
                   }else{                   
                        return '';
                   }
                })
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->addIndexColumn()
                ->rawColumns(['image', 'action'])
                ->escapeColumns(['action', 'name', 'image'])
                ->toJson();
        }

        return view('Central.Admin.default_themes.index');
    }

    public function create()
    {
        $ThemePages = DefaultThemePage::get();

        return view('Central.Admin.default_themes.create', compact('ThemePages'));
    }

    public function store(Request $request)
    {
        $theme = DefaultTheme::create(['title_ar' => $request->title_ar, 'title_en' => $request->title_en]);

        if ($request->hasFile('image')) {
            $theme->image = Upload::UploadFile($request->image, 'DefaultThemes');
        }

        foreach ($request->themePages as $item) {
            $theme->defaultThemePages()->attach($item);
        }

        $theme->save();

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function edit($id)
    {
        $ThemePages = DefaultThemePage::get();
        $Theme = DefaultTheme::find($id);

        return view('Central.Admin.default_themes.edit', compact(['Theme', 'ThemePages']));
    }

    public function update(Request $request, $id)
    {
        $theme = DefaultTheme::find($id);

        $theme->update(['title_ar' => $request->title_ar, 'title_en' => $request->title_en]);

        if ($request->hasFile('image')) {
            if ($theme->image) {
                Upload::deleteImage($theme->image);
            }
            $theme->image = Upload::UploadFile($request->image, 'DefaultThemes');
        }

        $theme->defaultThemePages()->sync($request->themePages);

        $theme->save();

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        DefaultTheme::find($id)->delete();

        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function previewDefaultTheme(Request $request)
    {
        //view components while creating a page
        $data = [];

        $themePage = DefaultThemePage::whereIn('id', explode(',', $request->ids))->get();

        foreach ($themePage->sortBy('order') as $key => $page) {
            $data[$key]['name'] = $page->title();
            foreach ($page->components->sortBy('row_id') as $item) {
                $data[$key][] = $item;
            }
        }

        return view('Mix.Admin.themes.fullThemePreview', compact('data'));
    }

    public function previewDefaultFullTheme($id)
    {
        //view full theme pages of theme

        $theme = DefaultTheme::find($id);

        $data = [];

        foreach ($theme->defaultThemePages as $key => $themePage) {
            $data[$key]['name'] = $themePage->title();
            foreach ($themePage->components->sortBy('row_id') as $item) {
                $data[$key][] = $item;
            }
        }

        return view('Mix.Admin.themes.fullThemePreview', compact('data'));
    }

    public function fullDefaultTheme($id)
    {
        $theme = DefaultTheme::find($id);
        $type = 'default';

        return view('Mix.Admin.theme_preview', compact('theme', 'type'));
    }
}
