<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Requests\Tenant\API\AddressRequest;
use App\Http\Resources\Tenant\AddressResource;
use App\Models\Tenant\Address;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $query = Address::query()
            ->with(['client', 'region','city','Block'])
            ->where('client_id', auth('sanctum')->id());
        $Addresses = $query->get();
        $this->CheckCount($Addresses);

        return ResponseHelper::make(AddressResource::collection($Addresses));
    }

    public function store($lang, AddressRequest $request)
    {
        $this->CheckAuth();
        $Address = Address::create(['client_id' => auth('sanctum')->id()] + $request->validated());

        return ResponseHelper::make(AddressResource::make($Address), __('messages.addedSuccessfully'));
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $Address = Address::query()
            ->where('id', $id)
            ->with(['client', 'region','city','Block'])
            ->where('client_id', auth('sanctum')->id())
            ->first();
        $this->CheckExist($Address);

        return ResponseHelper::make(AddressResource::make($Address));
    }

    public function update($lang, $id, AddressRequest $request)
    {
        $this->CheckAuth();
        $Address = Address::where('client_id', auth('sanctum')->id())->where('id', $id)->first();
        $this->CheckExist($Address);
        $Address->update($request->validated());

        return ResponseHelper::make(AddressResource::make($Address), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id)
    {
        $this->CheckAuth();
        $Address = Address::where('client_id', auth('sanctum')->id())->where('id', $id)->delete();

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }
}
