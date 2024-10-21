<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreAdminRequest;
use App\Http\Requests\Mix\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admins-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:admins-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admins-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admins-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Admins = Admin::whereHas('roles', function ($q) {
                $q->where('name', 'Admin');
            });

            return Datatables::of($Admins)
                ->addColumn('action', function ($Admin) {
                    return '<a style="color: #000;" href="'.route('admin.admins.show', $Admin).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.admins.edit', $Admin).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.admins.destroy', $Admin).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Mix.Admin.admins.index');
    }

    public function create()
    {
        $roles = Role::get();

        return view('Mix.Admin.admins.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $Admin = Admin::create($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        $Admin->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $Admin->image = Upload::UploadFile($request->image, 'Admins');
        }
        $Admin->save();
        $Admin->assignRole([1]);
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Admin = Admin::where('id', $id)->firstorfail();

        return view('Mix.Admin.admins.show', compact('Admin'));
    }

    public function edit($id)
    {
        $Admin = Admin::where('id', $id)->firstorfail();
        $roles = Role::get();

        return view('Mix.Admin.admins.edit', compact('Admin', 'roles'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $Admin = Admin::where('id', $id)->firstorfail();
        $Admin->update($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        if ($request->hasFile('image')) {
            $Admin->image = Upload::UploadFile($request->image, 'Admins');
        }
        if ($request->password) {
            $Admin->password = bcrypt($request->password);
        }
        $Admin->save();
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Admin = Admin::where('id', $id)->firstorfail();
        if (Admin::count()) {
            $Admin->delete();
            alert()->success(__('messages.User successfully Deleted'));

            return redirect()->back();
        } else {
            alert()->error(__('messages.cantDeleteElement'));

            return redirect()->back();
        }
    }
}
