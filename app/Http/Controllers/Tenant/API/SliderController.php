<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\SliderResource;
use App\Models\Image;
use Illuminate\Http\Request;

class SliderController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Image::where('type_id', 5)
            ->latest()
            ->Active();
        $Sliders = $query->get();
        $this->CheckCount($Sliders);

        return ResponseHelper::make(SliderResource::collection($Sliders));
    }

    public function show($lang, $id, Request $request)
    {
        $Slider = Image::where('type_id', 5)
            ->where('id', $id)
            ->latest()
            ->Active()
            ->first();
        $this->CheckExist($Slider);

        return ResponseHelper::make(SliderResource::make($Slider));
    }
}
