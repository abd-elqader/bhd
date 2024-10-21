<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreRegionRequest;
use App\Http\Requests\Mix\Admin\UpdateRegionRequest;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:regions-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:regions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:regions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:regions-delete', ['only' => ['destroy']]);
    }

    public function index($country_id , Request $request)
    {
        if ($request->ajax()) {
            $Regions = Region::latest()->where('country_id', $country_id);

            return DataTables::of($Regions)
                ->addColumn('action', function ($Region) {
    
                    return '
                        <a href="'.route('admin.country.regions.edit', ['country'=>request('country'),'region'=>$Region]).'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="formDelete" method="POST" action="'.route('admin.country.regions.destroy', ['country'=>request('country'),'region'=>$Region]).'">
                            '.csrf_field().'
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                <i class="fa-solid fa-eraser"></i>
                            </button>
                        </form>';
               
                })
                ->editColumn('title_ar', function ($Region) {
                    return '<a href="'.route('admin.country.regions.show', ['country'=>request('country'),'region'=>$Region]).'">'. $Region->title_ar .'</a>';
                })
                ->editColumn('title_en', function ($Region) {
                    return '<a href="'.route('admin.country.regions.show', ['country'=>request('country'),'region'=>$Region]).'">'. $Region->title_en .'</a>';
                })
                ->editColumn('status', function ($Region) {
                    if ($Region->status) {
                        return '<label data-id="'.$Region->id.'" onclick="toggleswitch('.$Region->id.',\'regions\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Region->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Region->id.'" onclick="toggleswitch('.$Region->id.',\'regions\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Region->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }
        
        dd(404);
    }

    public function create($country_id)
    {
        return view('Mix.Admin.regions.create');
    }

    public function store($country_id,Request $request)
    {
        $Region = Region::latest()->create(['country_id'=>$country_id]+$request->only('title_ar','title_en','status'));
        alert()->success(__('messages.addedSuccessfully'));
        return redirect()->back();
    }

    public function show($country_id,Region $Region)
    {
        return view('Mix.Admin.regions.show', compact('Region'));
    }

    public function edit($country_id,Region $Region)
    {
        return view('Mix.Admin.regions.edit', compact('Region'));
    }

    public function update($country_id,Request $request, Region $Region)
    {
        $Region->update(['country_id'=>$country_id]+$request->only('title_ar','title_en','status'));
        alert()->success(__('messages.updatedSuccessfully'));
        return redirect()->back();
    }

    public function destroy($country_id,Region $Region)
    {
        $Region->delete();
        alert()->success(__('messages.DeletedSuccessfully'));
        return redirect()->back();
    }
}
