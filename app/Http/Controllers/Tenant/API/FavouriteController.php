<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Requests\Tenant\API\ProductFavouriteRequest;
use App\Http\Resources\Tenant\ProductFavouriteResource;
use App\Models\Tenant\ProductFavourite;
use Illuminate\Http\Request;

class FavouriteController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $query = ProductFavourite::query()
            ->with(['Product'])
            ->where('client_id', auth('sanctum')->id());
        $ProductFavouritees = $query->get();
        $this->CheckCount($ProductFavouritees);

        return ResponseHelper::make(ProductFavouriteResource::collection($ProductFavouritees));
    }

    public function store($lang, ProductFavouriteRequest $request)
    {
        $this->CheckAuth();
        $ProductFavourite = ProductFavourite::create(['client_id' => auth('sanctum')->id()] + $request->validated());

        return ResponseHelper::make(ProductFavouriteResource::make($ProductFavourite), __('messages.addedSuccessfully'));
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $ProductFavourite = ProductFavourite::query()
            ->where('id', $id)
            ->with(['Product'])
            ->where('client_id', auth('sanctum')->id())
            ->first();
        $this->CheckExist($ProductFavourite);

        return ResponseHelper::make(ProductFavouriteResource::make($ProductFavourite));
    }

    public function update($lang, $id, ProductFavouriteRequest $request)
    {
        $this->CheckAuth();
        $ProductFavourite = ProductFavourite::where('client_id', auth('sanctum')->id())->where('id', $id)->first();
        $this->CheckExist($ProductFavourite);
        $ProductFavourite->update($request->validated());

        return ResponseHelper::make(ProductFavouriteResource::make($ProductFavourite), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id)
    {
        $this->CheckAuth();
        $ProductFavourite = ProductFavourite::where('client_id', auth('sanctum')->id())->where('product_id', $id)->delete();

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }
}
