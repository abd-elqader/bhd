<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $Notifications = Notification::latest()->where('client_id', auth('sanctum')->id())->get();
        $this->CheckCount($Notifications);

        return ResponseHelper::make(NotificationResource::collection($Notifications));
    }
}
