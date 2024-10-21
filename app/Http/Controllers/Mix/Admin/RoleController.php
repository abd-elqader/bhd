<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:roles-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = role::latest();

            return Datatables::of($roles)
                ->addColumn('action', function ($role) {
                    if ($role->id > 1) {
                        return '
                            <a style="color: #000;" href="'.route('admin.roles.show', $role).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.roles.edit', $role).'"><i class="fas fa-pen"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.roles.destroy', $role).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>
                            ';
                    }
                })
                ->addIndexColumn()
                ->addColumn('title', function ($Model) {
                    return $Model->title();
                })
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'checkbox', 'status')
                ->make(true);
        }

        return view('Mix.Admin.roles.index');
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('Mix.Admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ar' => 'required',
            'title_en' => 'required',
            'rolePermissions' => 'sometimes|required',
        ]);

        $role = Role::create([
            'name' => $request->input('title_en'),
            'title_ar' => $request->input('title_ar'),
            'title_en' => $request->input('title_en'),
        ]);
        if ($request->input('permissions') && count($request->input('permissions'))) {
            $role->syncPermissions($request->input('permissions'));
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where('role_has_permissions.role_id', $id)->get();

        return view('Mix.Admin.roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();

        return view('Mix.Admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_ar' => 'required',
            'title_en' => 'required',
            'permissions' => 'sometimes|required',
        ]);
        Role::find($id)->update([
            'name' => $request->title_en,
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
        ]);
        $role = Role::find($id);
        $role->syncPermissions($request->input('permissions'));
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        Role::find($id)->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
