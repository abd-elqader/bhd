<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $countries = Contact::latest();

            return DataTables::of($countries)
                ->addColumn('action', function ($Contact) {
                    return '<a style="color: #000;" href="'.route('admin.contact.show', $Contact).'"><i class="fas fa-eye"></i></a>';
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Mix.Admin.contacts.index');
    }

    public function show($id)
    {
        $Contact = Contact::latest()->find($id);

        return view('Mix.Admin.contacts.show', compact('Contact'));
    }
}
