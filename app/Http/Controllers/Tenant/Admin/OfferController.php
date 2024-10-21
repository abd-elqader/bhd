<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreOfferRequest;
use App\Models\Tenant\Category;
use App\Models\Tenant\Offer;
use App\Models\Tenant\OfferType;
use App\Models\Tenant\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:offers-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:offers-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:offers-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:offers-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Offers = Offer::latest();
            if ($request->type_id) {
                $Offers = $Offers->where('type_id', $request->type_id);
            }

            return DataTables::of($Offers)
                ->addColumn('action', function ($Offer) {
                    return '<a href="'.route('admin.offers.show', $Offer).'"><i class="fas fa-eye"></i></a>
                            <a href="'.route('admin.offers.edit', $Offer).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.offers.destroy', $Offer).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete">
                                    <i class="fa-solid fa-eraser"></i>
                                </button>
                            </form>';
                })
                ->editColumn('status', function ($Offer) {
                    if ($Offer->status) {
                        return '<label data-id="'.$Offer->id.'" onclick="toggleswitch('.$Offer->id.',\'Offers\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Offer->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$Offer->id.'" onclick="toggleswitch('.$Offer->id.',\'Offers\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$Offer->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addColumn('image', function ($item) {
                    return blank($item['image']) ? '' : '<img style="height: 100px" src="'.$item['image'].'" alt="IMG" width="150">';
                })
                ->editColumn('type_id', function ($Offer) {
                    return '<a style="color: blue;" href="'.route('admin.offertypes.index', ['id' => $Offer->type_id]).'">'.mb_strimwidth($Offer->Type->title(), 0, 50, '...').'</a>';
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->toJson();
        }

        return view('Tenant.Admin.offers.index');
    }

    public function create()
    {
        $OfferTypes = OfferType::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        $products = Product::where('status', 1)->get();

        return view('Tenant.Admin.offers.create', compact('OfferTypes', 'categories', 'products'));
    }

    public function store(StoreOfferRequest $request)
    {
        if (isset($request['products']['2']['x']['value'])) {
            $value = $request['products']['2']['x']['value'];
        } elseif (isset($request['products']['3']['x']['value'])) {
            $value = $request['products']['3']['x']['value'];
        } elseif (isset($request['categories']['2']['x']['value'])) {
            $value = $request['categories']['2']['x']['value'];
        } elseif (isset($request['categories']['3']['x']['value'])) {
            $value = $request['categories']['3']['x']['value'];
        } elseif (isset($request['products']['1']['y']['discount']['value'])) {
            $value = $request['products']['1']['y']['discount']['value'];
        } elseif (isset($request['products']['2']['value'])) {
            $value = $request['products']['2']['value'];
        } elseif (isset($request['products']['3']['value'])) {
            $value = $request['products']['3']['value'];
        } elseif (isset($request['categories']['2']['value'])) {
            $value = $request['categories']['2']['value'];
        } elseif (isset($request['categories']['3']['value'])) {
            $value = $request['categories']['3']['value'];
        } else {
            $value = 0;
        }
        $Offer = Offer::create([
            'image' => Upload::UploadFile($request['image'], 'offers'),
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'status' => $request->status,
            'type_id' => $request->type_id,
            'for' => $request->for_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'value' => $value,
        ]);
        InsertOfferData($request->all(), $Offer);

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Offer $Offer)
    {
        return view('Tenant.Admin.offers.show', compact('Offer'));
    }

    public function edit($id)
    {
        $Offer = Offer::with(['Products', 'Categories', 'ProductsData', 'CategoriesData'])->find($id);
        $OfferTypes = OfferType::get();
        $Categories = Category::get();
        $Products = Product::get();

        return view('Tenant.Admin.offers.edit', compact('Offer', 'OfferTypes', 'Categories', 'Products'));
    }

    public function update(StoreOfferRequest $request, $id)
    {
        $OldOffer = Offer::find($id);
        if (isset($request['products']['2']['x']['value'])) {
            $value = $request['products']['2']['x']['value'];
        } elseif (isset($request['products']['3']['x']['value'])) {
            $value = $request['products']['3']['x']['value'];
        } elseif (isset($request['categories']['2']['x']['value'])) {
            $value = $request['categories']['2']['x']['value'];
        } elseif (isset($request['categories']['3']['x']['value'])) {
            $value = $request['categories']['3']['x']['value'];
        } elseif (isset($request['products']['1']['y']['discount']['value'])) {
            $value = $request['products']['1']['y']['discount']['value'];
        } elseif (isset($request['products']['2']['value'])) {
            $value = $request['products']['2']['value'];
        } elseif (isset($request['products']['3']['value'])) {
            $value = $request['products']['3']['value'];
        } elseif (isset($request['categories']['2']['value'])) {
            $value = $request['categories']['2']['value'];
        } elseif (isset($request['categories']['3']['value'])) {
            $value = $request['categories']['3']['value'];
        } else {
            $value = 0;
        }
        $Offer = Offer::create([
            'image' => isset($request['image']) ? Upload::UploadFile($request['image'], 'offers') : $OldOffer->image,
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'status' => $request->status,
            'type_id' => $request->type_id,
            'for' => $request->for_id,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'value' => $value,
        ]);
        $OldOffer->delete();
        $Offer->update(['id' => $id]);
        $Offer->id = $id;
        $Offer->save();
        InsertOfferData($request->all(), $Offer);
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->route('admin.offers.index');
    }

    public function destroy(Offer $Offer)
    {
        $Offer->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
