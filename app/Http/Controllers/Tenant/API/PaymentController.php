<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Resources\Tenant\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function index($lang, Request $request)
    {
        $query = Payment::query()
            ->with('Images')
            ->Active();
        $Countries = $query->get();
        $this->CheckCount($Countries);

        return ResponseHelper::make(PaymentResource::collection($Countries));
    }

    public function show($lang, $id, Request $request)
    {
        $Payment = Payment::query()
            ->where('id', $id)
                ->with('Images')
            ->Active()
            ->first();
        $this->CheckExist($Payment);

        return ResponseHelper::make(PaymentResource::make($Payment));
    }
    
    public function success(Request $request)
    {
        return ResponseHelper::make(null, __('messages.successProcess'), true, 200);
    }
    public function failed(Request $request)
    {
        return ResponseHelper::make(null, __('messages.failedProcess'), false, 404);
    }
}
