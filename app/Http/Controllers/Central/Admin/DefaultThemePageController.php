<?php

namespace App\Http\Controllers\Central\Admin;

use App\Http\Controllers\Controller;
use App\Models\Central\Component;
use App\Models\Central\DefaultThemePage;
use App\Models\Central\DefaultThemePagesComponents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class DefaultThemePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:theme-pages-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:theme-pages-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:theme-pages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:theme-pages-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->theme_id) {
                $themes = DefaultThemePage::orderBy('title_'.lang())->whereHas('defaultThemes', function ($q) use ($request) {
                    $q->where('default_theme_id', $request->theme_id);
                })->latest();
            } else {
                $themes = DefaultThemePage::orderBy('title_'.lang());
            }

            return DataTables::of($themes)
                ->addColumn('action', function ($Theme) {
                    return '<a target="_blank" href="'.route('previewDefaultFullThemePage', $Theme->id).'"><i class="fa-solid fa-eye"></i></a>
                            <a href="'.route('admin.default_theme_pages.edit', $Theme->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.default_theme_pages.destroy', $Theme->id).'">
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
                ->escapeColumns(['action', 'name'])
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Central.Admin.default_theme_pages.index');
    }

    public function create()
    {
        $Components = Component::orderBy('title_'.lang())->get();

        return view('Central.Admin.default_theme_pages.create', compact('Components'));
    }

    public function store(Request $request)
    {
        $themePage = DefaultThemePage::create(['title_ar' => $request->title_ar, 'title_en' => $request->title_en, 'type' => $request->type, 'order' => $request->order]);
        foreach ($request->components as $key => $item) {
            $themePage->components()->attach($item, ['row_id' => ((float) $request->row_id[$key])]);
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function edit($id)
    {
        $Components = Component::orderBy('title_'.lang())->with('DefaultThemePages')->get();
        $Theme = DefaultThemePage::find($id);
        Session::forget(['defaultTheme', 'tenantTheme']);

        return view('Central.Admin.default_theme_pages.edit', compact(['Theme', 'Components']));
    }

    public function update(Request $request, $id)
    {
        $themePage = DefaultThemePage::find($id);

        $themePage->update(['title_ar' => $request->title_ar, 'title_en' => $request->title_en, 'type' => $request->type, 'order' => $request->order]);

        DefaultThemePagesComponents::where('default_theme_page_id', $themePage->id)->delete();

        foreach ($request->components as $key => $item) {
            $themePage->components()->attach($item, ['row_id' => ((float) $request->row_id[$key])]);
        }

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        DefaultThemePage::find($id)->delete();

        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function previewDefaultThemePage(Request $request)
    {
        //view components while creating a page
        $data = collect();
        foreach (explode(',', $request->ids) as $id) {
            $data[] = Component::find($id);
        }

        return view('Mix.Admin.themes.preview', compact('data'));
    }

    public function previewDefaultFullThemePage($id)
    {
        //view full components of theme page
        $theme = DefaultThemePage::find($id);

        $data = collect();

        foreach ($theme->components as $item) {
            $data[] = $item;
        }

        return view('Mix.Admin.themes.preview', compact('data'));
    }
}
