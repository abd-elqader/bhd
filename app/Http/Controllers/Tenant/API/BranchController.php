<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\BranchResource;
use App\Models\Tenant\Branch;
use Illuminate\Http\Request;

class BranchController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Branch::query()
            ->Active()
            ->with('WorkTime', 'Country');
        $Branches = $query->get();
        $this->CheckCount($Branches);

        return ResponseHelper::make(BranchResource::collection($Branches));
    }

    public function show($lang, $id, Request $request)
    {
        $Branch = Branch::query()
            ->where('id', $id)
            ->Active()
            ->with('WorkTime', 'Country')
            ->first();
        $this->CheckExist($Branch);

        return ResponseHelper::make(BranchResource::make($Branch));
    }
}
