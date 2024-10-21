<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\SizeResource;
use App\Models\Tenant\Size;
use Illuminate\Http\Request;

class SizeController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Size::query()
            ->Active();
        $Countries = $query->get();
        $this->CheckCount($Countries);

        return ResponseHelper::make(SizeResource::collection($Countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Size = Size::query()
            ->where('id', $id)
            ->Active()
            ->first();
        $this->CheckExist($Size);

        return ResponseHelper::make(SizeResource::make($Size));
    }
}
