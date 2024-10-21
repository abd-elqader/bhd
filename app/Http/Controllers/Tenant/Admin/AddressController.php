<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Admin\StoreAddressRequest;
use App\Http\Requests\Tenant\Admin\UpdateAddressRequest;
use App\Models\Client;
use App\Models\Region;
use App\Models\Tenant\Address;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:address-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:address-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:address-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:address-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request, Client $client)
    {
        if ($request->ajax()) {
            $Addresss = Address::where('client_id', $client->id)->with('client', 'region')->get();

            return Datatables::of($Addresss)
                ->addColumn('action', function ($address) {
                    return '<a style="color: #000;" href="'.route('admin.addresses.show', $address).'"><i class="fas fa-eye"></i></a>
                            <a style="color: #000;" href="'.route('admin.addresses.edit', $address).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="formDelete" method="POST" action="'.route('admin.addresses.destroy', $address).'">
                                '.csrf_field().'
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="button" class="btn btn-flat show_confirm" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-eraser"></i></button>
                            </form>';
                })
                ->addColumn('client', function ($address) {
                    return $address->client->name;
                })
                ->addColumn('region', function ($address) {
                    return $address->region->title();
                })
                ->addColumn('email', function ($address) {
                    return $address->client->email;
                })
                ->addIndexColumn()
                ->addColumn('checkbox', function ($Model) {
                    return '<input type="checkbox" class="DTcheckbox" value="'.$Model->id.'">';
                })
                ->escapeColumns('action', 'client', 'region', 'email')
                ->make(true);
        }

        return view('Tenant.Admin.addresses.index', compact('client'));
    }

    public function create(Client $client)
    {
        $regions = Region::get();

        return view('Tenant.Admin.addresses.create', compact('regions', 'client'));
    }

    public function store(StoreAddressRequest $request)
    {
        Address::create($request->validated());
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function show(Address $address)
    {
        return view('Tenant.Admin.addresses.show', compact('address'));
    }

    public function edit(Address $address)
    {
        $regions = Region::get();

        return view('Tenant.Admin.addresses.edit', compact('address', 'regions'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->validated());
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Address $address)
    {
        $address->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
