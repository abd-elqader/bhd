<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\ColorResource;
use App\Models\Tenant\Color;
use Illuminate\Http\Request;

class ColorController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Color::query()
            ->Active();
        $Countries = $query->get();
        $this->CheckCount($Countries);

        return ResponseHelper::make(ColorResource::collection($Countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Color = Color::query()
            ->where('id', $id)
            ->Active()
            ->first();
        $this->CheckExist($Color);

        return ResponseHelper::make(ColorResource::make($Color));
    }
}
