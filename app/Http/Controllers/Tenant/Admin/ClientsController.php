<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreClientRequest;
use App\Http\Requests\Mix\Admin\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clients-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:clients-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:clients-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:clients-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Clients = Client::query();

            return Datatables::of($Clients)
                ->addColumn('action', function ($Client) {
                    return '<a style="color: #000;" href="'.route('admin.clients.show', $Client).'"><i class="fas fa-eye"></i></a>
                        <a style="color: #000;" href="'.route('admin.clients.edit', $Client).'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="formDelete" method="POST" action="'.route('admin.clients.destroy', $Client).'">
                            '.csrf_field().'
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                        </form>';
                })
                ->addColumn('addresses', function ($Client) {
                    return '<a href="'.route('admin.addresses.index', $Client).'"><button class="btn btn-primary">'.__('dashboard.addresses').'</button></a>';
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status', 'addresses')
                ->make(true);
        }

        return view('Tenant.Admin.clients.index');
    }

    public function create()
    {
        return view('Tenant.Admin.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $Client = Client::create($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        $Client->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $Client->image = Upload::UploadFile($request->image, 'Clients');
        }
        $Client->save();
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Client = Client::findorfail($id);
        return view('Tenant.Admin.clients.show', compact('Client'));
    }

    public function edit($id)
    {
        $Client = Client::findorfail($id);
        return view('Tenant.Admin.clients.edit', compact('Client'));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        $Client = Client::findorfail($id);
        $Client->update($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        if ($request->hasFile('image')) {
            $Client->image = Upload::UploadFile($request->image, 'Clients');
        }
        if ($request->password) {
            $Client->password = bcrypt($request->password);
        }
        $Client->save();
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Client = Client::findorfail($id);
        $Client->forcedelete();
        alert()->success(__('messages.Client successfully Deleted'));

        return redirect()->back();
    }
}
