<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Region::query()
            ->when($request->country_id, function ($query) use($request) {
                return $query->where('country_id', $request->country_id);
            })
            ->with('Blocks')
            ->Active();
        $regions = $query->get();
        $this->CheckCount($regions);
        return ResponseHelper::make(RegionResource::collection($regions));
    }

    public function show($lang, $id, Request $request)
    {
        $Region = Region::query()
            ->with('Blocks')
            ->where('id', $id)
            ->Active()
            ->first();
        $this->CheckExist($Region);

        return ResponseHelper::make(RegionResource::make($Region));
    }
}
