<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StorePaymentMethodRequest;
use App\Http\Requests\Mix\Admin\UpdatePaymentMethodRequest;
use App\Models\Payment;
use App\Models\PaymentImages;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:payments-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:payments-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:payments-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:payments-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $PaymentMethods = Payment::latest();

            return Datatables::of($PaymentMethods)
                ->addColumn('action', function ($PaymentMethod) {
                    return '<a href="'.route('admin.payments.edit', $PaymentMethod).'"><i class="fa-solid fa-pen-to-square"></i></a>';
                })
                ->addColumn('image', function ($PaymentMethod) {
                    return '<img style="height: 100px" src="'.$PaymentMethod->Images?->first()?->image.'" alt="IMG" width="150">';
                })
                ->editColumn('status', function ($PaymentMethod) {
                    if ($PaymentMethod->status) {
                        return '<label data-id="'.$PaymentMethod->id.'" onclick="toggleswitch('.$PaymentMethod->id.',\'payments\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$PaymentMethod->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$PaymentMethod->id.'" onclick="toggleswitch('.$PaymentMethod->id.',\'payments\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$PaymentMethod->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Mix.Admin.payments.index');
    }

    public function create()
    {
        return view('Mix.Admin.payments.create');
    }

    public function store(StorePaymentMethodRequest $request)
    {
        $PaymentMethod = Payment::latest()->create($request->validated());
        if ($request->hasFile('image')) {
            foreach (Upload::UploadFiles($request['image'], 'PaymentMethods') as $image) {
                PaymentImages::insert([
                    'image' => $image,
                    'payment_id' => $PaymentMethod['id'],
                ]);
            }
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Payment $PaymentMethod)
    {
        return view('Mix.Admin.payments.show', compact('PaymentMethod'));
    }

    public function edit($id)
    {
        $PaymentMethod = Payment::latest()->where('id', $id)->firstorfail();

        return view('Mix.Admin.payments.edit', compact('PaymentMethod'));
    }

    public function update(UpdatePaymentMethodRequest $request, $id)
    {
        $PaymentMethod = Payment::latest()->where('id', $id)->firstorfail();
        $PaymentMethod->update($request->validated());
        if ($request->hasFile('image')) {
            PaymentImages::where('payment_id', $PaymentMethod['id'])->delete();
            PaymentImages::insert([
                'image' => Upload::UploadFile($request['image'], 'PaymentMethods'),
                'payment_id' => $PaymentMethod['id'],
            ]);
            
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        Payment::latest()->where('id', $id)->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
