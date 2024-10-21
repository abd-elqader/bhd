<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\WeightResource;
use App\Models\Tenant\Weight;
use Illuminate\Http\Request;

class WeightController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Weight::query()
            ->Active();
        $Countries = $query->get();
        $this->CheckCount($Countries);

        return ResponseHelper::make(WeightResource::collection($Countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Weight = Weight::query()
            ->where('id', $id)
            ->Active()
            ->first();
        $this->CheckExist($Weight);

        return ResponseHelper::make(WeightResource::make($Weight));
    }
}
