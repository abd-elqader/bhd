<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Requests\Tenant\API\ComplaintRequest;
use App\Http\Resources\Tenant\ComplaintResource;
use App\Models\Tenant\Complaint;
use App\Models\Tenant\Message;
use Illuminate\Http\Request;

class ComplaintsController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $query = Complaint::query()
            ->with(['messages'])
            ->where('client_id', auth('sanctum')->id());
        $Complaints = $query->get();
        $this->CheckCount($Complaints);

        return ResponseHelper::make(ComplaintResource::collection($Complaints));
    }

    public function store($lang, ComplaintRequest $request)
    {
        $this->CheckAuth();
        $Complaint = Complaint::create(['client_id' => auth('sanctum')->id()] + $request->validated());
        $Message = Message::create([
            'client_id' => auth('sanctum')->id(),
            'content' => $request->content,
            'complaint_id' => $Complaint->id,
            'type_id' => 1,
            'type' => 1,
        ]);

        return ResponseHelper::make(ComplaintResource::make($Complaint->refresh()), __('messages.addedSuccessfully'));
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $Complaint = Complaint::query()
            ->where('id', $id)
            ->with(['messages'])
            ->where('client_id', auth('sanctum')->id())
            ->first();
        $this->CheckExist($Complaint);

        return ResponseHelper::make(ComplaintResource::make($Complaint));
    }

    public function update($lang, $id, ComplaintRequest $request)
    {
        $this->CheckAuth();
        $Complaint = Complaint::where('client_id', auth('sanctum')->id())->where('id', $id)->first();
        $this->CheckExist($Complaint);
        $Complaint->update($request->validated());

        return ResponseHelper::make(ComplaintResource::make($Complaint), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id)
    {
        $this->CheckAuth();
        $Complaint = Complaint::where('client_id', auth('sanctum')->id())->where('id', $id)->delete();

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }
}
