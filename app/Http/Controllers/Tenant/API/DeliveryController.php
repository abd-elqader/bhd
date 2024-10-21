<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\DelivryResource;
use App\Models\Tenant\Delivry;
use Illuminate\Http\Request;

class DeliveryController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Delivry::query()
            ->Active();
        $Countries = $query->get();
        $this->CheckCount($Countries);

        return ResponseHelper::make(DelivryResource::collection($Countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Delivry = Delivry::query()
            ->where('id', $id)
            ->Active()
            ->first();
        $this->CheckExist($Delivry);

        return ResponseHelper::make(DelivryResource::make($Delivry));
    }
}
