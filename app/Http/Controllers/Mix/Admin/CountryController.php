<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreCountryRequest;
use App\Http\Requests\Mix\Admin\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:countries-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:countries-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:countries-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:countries-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Country::latest();

            return DataTables::of($countries)
                ->addColumn('action', function ($Country) {
                    return '<a href="'.route('admin.countries.show', $Country).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.countries.edit', $Country).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.countries.destroy', $Country).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->editColumn('title_ar', function ($Country) {
                    return '<a href="'.route('admin.countries.show', $Country).'">'. $Country->title_ar .'</a>';
                })
                ->editColumn('title_en', function ($Country) {
                    return '<a href="'.route('admin.countries.show', $Country).'">'. $Country->title_en .'</a>';
                })
                ->editColumn('status', function ($Country) {
                    if ($Country->status) {
                        return '<label data-id="'.$Country->id.'" onclick="toggleswitch('.$Country->id.',\'countries\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Country->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Country->id.'" onclick="toggleswitch('.$Country->id.',\'countries\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Country->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addColumn('image', function ($Model) {
                    return '<a class="image-popup-no-margins" href="'.$Model['image'].'">
                        <img src="'.public_asset($Model->image).'" style="max-height: 150px;max-width: 150px">
                    </a>';
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Mix.Admin.countries.index');
    }

    public function create()
    {
        return view('Mix.Admin.countries.create');
    }

    public function store(StoreCountryRequest $request)
    {
        if ($request->hasFile('image')) {
            $Country = Country::latest()->create(['image' => Upload::UploadFile($request['image'], 'countries')] + $request->validated());
        } else {
            $Country = Country::latest()->create($request->validated());
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Country $Country)
    {
        return view('Mix.Admin.countries.show', compact('Country'));
    }

    public function edit(Country $Country)
    {
        return view('Mix.Admin.countries.edit', compact('Country'));
    }

    public function update(UpdateCountryRequest $request, Country $Country)
    {
        if ($request->hasFile('image')) {
            $Country->update(['image' => Upload::UploadFile($request['image'], 'countries')] + $request->validated());
        } else {
            $Country->update($request->validated());
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Country $Country)
    {
        $Country->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
