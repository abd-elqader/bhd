<?php

namespace App\Http\Controllers\Central\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\StorePackageRequest;
use App\Http\Requests\Central\Admin\UpdatePackageRequest;
use App\Models\Central\FeatureHeader;
use App\Models\Central\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:packages-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:packages-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:packages-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:packages-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Packages = Package::latest();

            return Datatables::of($Packages)
                ->addColumn('action', function ($Package) {
                    return '<a style="color: #000;" href="'.route('admin.packages.show', $Package).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.packages.edit', $Package).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.packages.destroy', $Package).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->editColumn('status', function ($item) {
                    if ($item->status) {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'packages\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$item->id.'" onclick="toggleswitch('.$item->id.',\'packages\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$item->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Central.Admin.packages.index');
    }

    public function create()
    {
        $FeatureHeader = FeatureHeader::with(['features' => function ($q) {
            $q->where('status', 1)->with('Packages');
        }])->get();

        return view('Central.Admin.packages.create', compact('FeatureHeader'));
    }

    public function store(StorePackageRequest $request)
    {
        $Package = Package::create($request->only('title_ar', 'title_en', 'price_ar', 'price_en', 'days', 'price','discount', 'status'));
        if ($request->feature_id && $request->feature_title_a && count($request->feature_id) == count($request->feature_title_ar) && count($request->feature_title_ar) == count($request->feature_title_en)) {
            $Package->Features()->detach();
            foreach ($request->feature_title_ar as $key => $item) {
                $Package->Features()->attach($request->feature_id[$key], [
                    'title_ar' => $request->feature_title_ar[$key],
                    'title_en' => $request->feature_title_en[$key],
                ]);
            }
        }else{
            $Package->Features()->attach(\App\Models\Central\Feature::select('id')->pluck('id')->toarray());
        }
        if ($request->desc_title_ar && $request->desc_title_en && count($request->desc_title_ar) == count($request->desc_title_en)) {
            foreach ($request->desc_title_ar as $key => $item) {
                $Package->Descriptions()->create([
                    'title_ar' => $request->desc_title_ar[$key],
                    'title_en' => $request->desc_title_en[$key],
                ]);
            }
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Package $Package)
    {
        return view('Central.Admin.packages.show', compact('Package'));
    }

    public function edit(Package $Package)
    {
        $FeatureHeader = FeatureHeader::with(['features' => function ($q) {
            $q->where('status', 1)->with('Packages');
        }])->get();

        return view('Central.Admin.packages.edit', compact('Package', 'FeatureHeader'));
    }

    public function update(UpdatePackageRequest $request, Package $Package)
    {
        $Package->update($request->only('title_ar', 'title_en', 'price_ar', 'price_en','days',  'price','discount', 'status'));
        $Package->Features()->detach();
        if ($request->feature_id && $request->feature_title_a && count($request->feature_id) == count($request->feature_title_ar) && count($request->feature_title_ar) == count($request->feature_title_en)) {
            foreach ($request->feature_title_ar as $key => $item) {
                $Package->Features()->attach($request->feature_id[$key], [
                    'title_ar' => $request->feature_title_ar[$key],
                    'title_en' => $request->feature_title_en[$key],
                ]);
            }
        }else{
            $Package->Features()->attach(\App\Models\Central\Feature::select('id')->pluck('id')->toarray());
        }
        $Package->Descriptions()->delete();
        if ($request->desc_title_ar && $request->desc_title_en && count($request->desc_title_ar) == count($request->desc_title_en)) {
            foreach ($request->desc_title_ar as $key => $item) {
                $Package->Descriptions()->create([
                    'title_ar' => $request->desc_title_ar[$key],
                    'title_en' => $request->desc_title_en[$key],
                ]);
            }
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Package $Package)
    {
        $Package->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
