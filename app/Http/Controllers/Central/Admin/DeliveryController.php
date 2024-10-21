<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Models\Central\Delivery;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deliveries-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:deliveries-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:deliveries-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:deliveries-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $deliveries = Delivery::latest();

            return DataTables::of($deliveries)
                ->addColumn('action', function ($Delivery) {
                    return '<a href="'.route('admin.deliveries.show', $Delivery).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.deliveries.edit', $Delivery).'"><i class="fa-solid fa-pen-to-square"></i></a>';
                })
                ->editColumn('same_day_price', function ($Delivery) {
                     return $Delivery->same_day_price . ' BHD';
                })
                ->editColumn('next_day_price', function ($Delivery) {
                     return $Delivery->next_day_price . ' BHD';
                })
                ->editColumn('status', function ($Delivery) {
                    if ($Delivery->status) {
                        return '<label data-id="'.$Delivery->id.'" onclick="toggleswitch('.$Delivery->id.',\'deliveries\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Delivery->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Delivery->id.'" onclick="toggleswitch('.$Delivery->id.',\'deliveries\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Delivery->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addColumn('image', function ($Delivery) {
                    return '<a class="image-popup-no-margins" href="'.$Delivery->image.'">
                        <img src="'.asset($Delivery->image).'" style="max-height: 150px;max-width: 150px">
                    </a>';
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
          
                ->toJson();
        }

        return view('Central.Admin.deliveries.index');
    }

    public function show(Delivery $Delivery)
    {
        return view('Central.Admin.deliveries.show', compact('Delivery'));
    }

    public function edit(Delivery $Delivery)
    {
        return view('Central.Admin.deliveries.edit', compact('Delivery'));
    }

    public function update(Request $request, Delivery $Delivery)
    {
        if ($request->hasFile('image')) {
            $Delivery->update(['image' => Upload::UploadFile($request['image'], 'deliveries')] + $request->all());
        } else {
            $Delivery->update($request->all());
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

}
