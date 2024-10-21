<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\CategoryResource;
use App\Models\Tenant\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Category::query()
            ->whereNULL('parent_id')
            ->Active()
            ->withcount('products')
            ->orderBy('id', 'asc');
        $countries = $query->get();
        $this->CheckCount($countries);

        return ResponseHelper::make(CategoryResource::collection($countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Category = Category::query()
            ->whereNULL('parent_id')
            ->Active()
            ->where('id', $id)
            ->withcount('products')
            ->latest()
            ->first();
        $this->CheckExist($Category);

        return ResponseHelper::make(CategoryResource::make($Category));
    }
}
