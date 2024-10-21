<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreFAQRequest;
use App\Http\Requests\Tenant\Admin\UpdateFAQRequest;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FAQController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:faq-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:faq-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faq-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faq-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $FAQs = FAQ::latest();

            return Datatables::of($FAQs)
                ->addColumn('action', function ($FAQ) {
                    return '<a style="color: #000;" href="'.route('admin.faq.show', $FAQ).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.faq.edit', $FAQ).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.faq.destroy', $FAQ).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->editColumn('status', function ($FAQ) {
                    if ($FAQ->status) {
                        return '<label data-id="'.$FAQ->id.'"  onclick="toggleswitch('.$FAQ->id.',\'f_a_q_s\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$FAQ->id.'" type="checkbox" checked ><span class="slider"></span></label>';
                    } else {
                        return '<label data-id="'.$FAQ->id.'"  onclick="toggleswitch('.$FAQ->id.',\'f_a_q_s\')" class="switch toggleswitch bg-dark"><input id="checkbox'.$FAQ->id.'" type="checkbox" ><span class="slider"></span></label>';
                    }
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Mix.Admin.faq.index');
    }

    public function create()
    {
        return view('Mix.Admin.faq.create');
    }

    public function store(StoreFAQRequest $request)
    {
        FAQ::create($request->validated());

        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $faq = FAQ::latest()->findOrFail($id);

        return view('Mix.Admin.faq.show', compact('faq'));
    }

    public function edit($id)
    {
        $FAQ = FAQ::latest()->findOrFail($id);

        return view('Mix.Admin.faq.edit', compact('FAQ'));
    }

    public function update(UpdateFAQRequest $request, $id)
    {
        FAQ::latest()->findOrFail($id)->update($request->validated());

        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $faq = FAQ::latest()->findOrFail($id);
        $faq->delete();

        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }

    public function switch()
    {
        $faq = FAQ::latest()->findOrFail(request('id'));
        $faq->status = request('status');
        $faq->save();
    }
}
