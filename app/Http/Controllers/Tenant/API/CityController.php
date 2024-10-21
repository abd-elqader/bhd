<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = City::query()
            ->when($request->region_id, function ($query) use($request) {
                return $query->where('region_id', $request->region_id);
            })
            ->Active();
        $Cities = $query->get();
        $this->CheckCount($Cities);
        return ResponseHelper::make(CityResource::collection($Cities));
    }

    public function show($lang, $id, Request $request)
    {
        $City = City::query()
            ->where('id', $id)
            ->Active()
            ->first();
        $this->CheckExist($City);

        return ResponseHelper::make(CityResource::make($City));
    }
}
