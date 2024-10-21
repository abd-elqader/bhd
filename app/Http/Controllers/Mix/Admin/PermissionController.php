<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:permissions-list', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:permissions-create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:permissions-edit', ['only' => ['edit', 'update']]);
    //     $this->middleware('permission:permissions-delete', ['only' => ['destroy']]);
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::latest();

            return Datatables::of($permissions)
                ->addColumn('action', function ($permission) {
                    return '<a style="color: #000;" href="'.route('admin.permissions.edit', $permission).'"><i class="fa-solid fa-pen-to-square"></i></a>';
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

        return view('Mix.Admin.permissions.index');
    }

    public function create()
    {
        // abort(404);
        return view('Mix.Admin.permissions.create');
    }

    public function store(Request $request)
    {
        // abort(404);
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
        Permission::create(['name' => $request->input('name').'-list']);
        Permission::create(['name' => $request->input('name').'-create']);
        Permission::create(['name' => $request->input('name').'-edit']);
        Permission::create(['name' => $request->input('name').'-delete']);
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('Mix.Admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_ar' => 'required',
            'title_en' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->title_ar = $request->input('title_ar');
        $permission->title_en = $request->input('title_en');
        $permission->save();
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        abort(404);
        Permission::find($id)->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
