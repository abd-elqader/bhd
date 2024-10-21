<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Models\Central\Component;
use App\Models\Central\DefaultThemePage;
use App\Models\TenantComponents;
use App\Models\ThemePage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ThemePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:theme-pages-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:theme-pages-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:theme-pages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:theme-pages-delete', ['only' => ['destroy']]);
    }

    public function defaultIndex(Request $request)
    {
        //get default theme pages created by central admin
        if ($request->ajax()) {
            if ($request->theme_id || $request->type) {
                if ($request->type == 'default') {
                    $themes = DefaultThemePage::whereHas('defaultThemes', function ($q) use ($request) {
                        $q->where('default_theme_id', $request->theme_id);
                    })->latest();
                } else {
                    $themes = collect();
                }
            } else {
                $themes = DefaultThemePage::latest();
            }

            return DataTables::of($themes)
                ->addColumn('action', function ($Theme) {
                    return '<a target="_blank" href="'.route('previewDefaultFullThemePage', $Theme->id).'"><i class="fa-solid fa-eye"></i></a>';
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

        return view('Mix.Admin.theme_pages.index');
    }

    public function index(Request $request)
    {
        //get theme pages created by tenant admin
        if ($request->ajax()) {
            if ($request->theme_id || $request->type) {
                if ($request->type == 'tenant') {
                    $themes = ThemePage::whereHas('themes', function ($q) use ($request) {
                        if ($request->theme_id || $request->type == 'tenant') {
                            $q->where('theme_id', $request->theme_id);
                        }
                    })->latest();
                } else {
                    $themes = collect();
                }
            } else {
                $themes = ThemePage::latest();
            }

            return DataTables::of($themes)
                ->addColumn('action', function ($Theme) {
                    return '<a target="_blank" href="'.route('previewFullThemePage', $Theme->id).'"><i class="fa-solid fa-eye"></i></a>
                            <a href="'.route('admin.theme_pages.edit', $Theme->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.theme_pages.destroy', $Theme->id).'">
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

        return view('Mix.Admin.theme_pages.index');
    }

    public function create()
    {
        $components = Component::select(['title_ar', 'title_en', 'link', 'preview', 'type', 'row_id', 'pages', 'path'])->whereNotIn('link', TenantComponents::select(['link'])->get()->toArray())->get();

        if ($components != null) {
            TenantComponents::insert($components->toArray());
        }

        $Components = TenantComponents::get();

        if (Component::count() != $Components->count()) {
            TenantComponents::whereNotIn('link', Component::select(['link'])->get()->toArray())->delete();
            $Components = TenantComponents::get();
        }

        return view('Mix.Admin.theme_pages.create', compact('Components'));
    }

    public function store(Request $request)
    {
        $themePage = ThemePage::create(['title_ar' => $request->title_ar, 'title_en' => $request->title_en, 'type' => $request->type, 'order' => $request->order]);

        foreach ($request->components as $key => $item) {
            $themePage->tenantComponents()->attach($item, ['row_id' => ((float) $request->row_id[$key])]);
        }

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(ThemePage $themePage)
    {
        return view('Mix.Admin.theme_pages.show', compact('Theme'));
    }

    public function edit($id)
    {
        $components = Component::select(['title_ar', 'title_en', 'link', 'preview', 'type', 'row_id', 'pages', 'path'])->whereNotIn('link', TenantComponents::select(['link'])->get()->toArray())->get();

        if ($components != null) {
            TenantComponents::insert($components->toArray());
        }

        $allComponents = TenantComponents::get();

        if (Component::count() != $allComponents->count()) {
            TenantComponents::whereNotIn('link', Component::select(['link'])->get()->toArray())->delete();
            $allComponents = TenantComponents::get();
        }

        $Theme = ThemePage::find($id);

        $components = $Theme->tenantComponents;

        return view('Mix.Admin.theme_pages.edit', compact(['Theme', 'components', 'allComponents']));
    }

    public function update(Request $request, $id)
    {
        $themePage = ThemePage::find($id);

        $themePage->update(['title_ar' => $request->title_ar, 'title_en' => $request->title_en, 'type' => $request->type, 'order' => $request->order]);

        // $themePage->tenantComponents()->sync($request->components);
        $themePage->tenantComponents()->detach();

        foreach ($request->components as $key => $item) {
            $themePage->tenantComponents()->attach($item, ['row_id' => ((float) $request->row_id[$key])]);
        }

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        ThemePage::find($id)->delete();

        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function previewThemePage(Request $request)
    {
        //show components of theme page while creating
        $data = collect();

        foreach (explode(',', $request->ids) as $id) {
            $data[] = TenantComponents::find($id);
        }

        return view('Mix.Admin.themes.preview', compact('data'));
    }

    public function previewFullThemePage($id)
    {
        //show full tenant theme page
        $themePage = ThemePage::find($id);

        $data = collect();

        foreach ($themePage->tenantComponents as $item) {
            $data[] = $item;
        }

        return view('Mix.Admin.themes.preview', compact('data'));
    }

    public function previewDefaultFullThemePage($id)
    {
        //show default full theme of page
        $theme = DefaultThemePage::find($id);

        $data = collect();

        foreach ($theme->components as $item) {
            $data[] = $item;
        }

        return view('Mix.Admin.themes.preview', compact('data'));
    }
}
