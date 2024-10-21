<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\MessageTypeResource;
use App\Models\Tenant\MessageType;
use Illuminate\Http\Request;

class MessageTypesController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = MessageType::query();
        $MessageTypes = $query->get();
        $this->CheckCount($MessageTypes);

        return ResponseHelper::make(MessageTypeResource::collection($MessageTypes));
    }

    public function show($lang, $id, Request $request)
    {
        $MessageType = MessageType::query()
            ->where('id', $id)
            ->first();
        $this->CheckExist($MessageType);

        return ResponseHelper::make(MessageTypeResource::make($MessageType));
    }
}
