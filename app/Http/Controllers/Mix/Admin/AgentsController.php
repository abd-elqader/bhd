<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreAdminRequest;
use App\Http\Requests\Mix\Admin\UpdateAdminRequest;
use App\Models\Admin as Agent;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AgentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:agents-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:agents-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:agents-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:agents-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Agents = Agent::whereHas('roles', function ($q) {
                $q->where('id','!=', 1);
            });

            return Datatables::of($Agents)
                ->addColumn('action', function ($Agent) {
                    return '<a style="color: #000;" href="'.route('admin.agents.show', $Agent).'"><i class="fas fa-eye"></i></a>
                        <a style="color: #000;" href="'.route('admin.agents.edit', $Agent).'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="formDelete" method="POST" action="'.route('admin.agents.destroy', $Agent).'">
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

        return view('Mix.Admin.agents.index');
    }

    public function create()
    {
        $roles = Role::where('id', '>', 1)->get();

        return view('Mix.Admin.agents.create', compact('roles'));
    }

    public function store(StoreAdminRequest $request)
    {
        $Agent = Agent::create($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        $Agent->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $Agent->image = Upload::UploadFile($request->image, 'Agents');
        }
        $Agent->save();
        if ($request->role_id) {
            $Agent->assignRole([$request->role_id]);
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Agent $Agent)
    {
        $Agent = $Agent->firstorfail();

        return view('Mix.Admin.agents.show', compact('Agent'));
    }

    public function edit(Agent $Agent)
    {
        $roles = Role::where('id', '>', 1)->get();

        return view('Mix.Admin.agents.edit', compact('Agent', 'roles'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $Agent = Agent::where('id', $id)->firstorfail();
        $Agent->update($request->only(['name', 'email', 'phone', 'country_code', 'phone_code']));
        if ($request->hasFile('image')) {
            $Agent->image = Upload::UploadFile($request->image, 'Agents');
        }
        if ($request->password) {
            $Agent->password = bcrypt($request->password);
        }
        $Agent->save();
        if ($request->role_id) {
            $Agent->roles()->detach();
            $Agent->assignRole([$request->role_id]);
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy($id)
    {
        $Agent = Agent::where('id', $id)->firstorfail();
        $Agent->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
