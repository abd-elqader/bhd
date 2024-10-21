<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:cities-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:cities-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cities-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cities-delete', ['only' => ['destroy']]);
    }

    public function index($country_id,$region_id,Request $request)
    {
        if ($request->ajax()) {
            $cities = City::latest()->where('region_id', $region_id);
            

            return DataTables::of($cities)
                ->addColumn('action', function ($City) {
    
                    return '
                        <a href="'.route('admin.country.region.cities.edit', ['country'=>request('country'),'region'=>request('region'),'city'=>$City]).'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="formDelete" method="POST" action="'.route('admin.country.region.cities.destroy', ['country'=>request('country'),'region'=>request('region'),'city'=>$City]).'">
                            '.csrf_field().'
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                <i class="fa-solid fa-eraser"></i>
                            </button>
                        </form>';
               
                })

                ->editColumn('status', function ($City) {
                    if ($City->status) {
                        return '<label data-id="'.$City->id.'" onclick="toggleswitch('.$City->id.',\'cities\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$City->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$City->id.'" onclick="toggleswitch('.$City->id.',\'cities\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$City->id.'" type="checkbox" ><span class="slider"></span></label>';
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

    public function create($country_id,$region_id)
    {
        return view('Mix.Admin.cities.create');
    }

    public function store($country_id,$region_id,Request $request)
    {
        $City = City::latest()->create(['region_id'=>$region_id]+$request->only('title_ar','title_en','status'));
        alert()->success(__('messages.addedSuccessfully'));
        return redirect()->back();
    }

    public function show($country_id,$region_id,City $City)
    {
        return view('Mix.Admin.cities.show', compact('City'));
    }

    public function edit($country_id,$region_id,City $City)
    {
        return view('Mix.Admin.cities.edit', compact('City'));
    }

    public function update($country_id,$region_id,Request $request, City $City)
    {
        $City->update(['region_id'=>$region_id]+$request->only('title_ar','title_en','status'));
        alert()->success(__('messages.updatedSuccessfully'));
        return redirect()->back();
    }

    public function destroy($country_id,$region_id,City $City)
    {
        $City->delete();
        alert()->success(__('messages.DeletedSuccessfully'));
        return redirect()->back();
    }
}
