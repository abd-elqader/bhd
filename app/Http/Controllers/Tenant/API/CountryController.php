<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Country::query()
            ->Active()
            ->withcount('regions');
        $Countries = $query->get();
        $this->CheckCount($Countries);

        return ResponseHelper::make(CountryResource::collection($Countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Country = Country::query()
            ->where('id', $id)
            ->Active()
            ->withcount('regions')
            ->first();
        $this->CheckExist($Country);

        return ResponseHelper::make(CountryResource::make($Country));
    }
}
