<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Requests\Tenant\API\MessageRequest;
use App\Http\Resources\Tenant\MessageRescource;
use App\Models\Tenant\Message;
use Illuminate\Http\Request;

class MessagesController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $query = Message::query()
            ->where('type_id', $request->type_id);
        if ($request->type_id == 1) {
            $query = $query->where('client_id', auth('sanctum')->id());
        }
        $Messages = $query->get();
        $this->CheckCount($Messages);

        return ResponseHelper::make(MessageRescource::collection($Messages));
    }

    public function store($lang, MessageRequest $request)
    {
        $this->CheckAuth();
        $Message = Message::create([
            'client_id' => auth('sanctum')->id(),
            'content' => $request->content,
            'complaint_id' => $request->complaint_id,
            'type_id' => 1,
            'type' => 1,
        ]);

        return ResponseHelper::make(['messages' => MessageRescource::collection(Message::where('complaint_id', $request->complaint_id)->get())], __('messages.addedSuccessfully'));
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $Message = Message::query()
            ->where('type_id', $request->type_id)
            ->where('id', $id);

        if ($request->type_id == 1) {
            $query = $query->where('client_id', auth('sanctum')->id());
        }
        $query = $query->first();
        $this->CheckExist($Message);

        return ResponseHelper::make(MessageRescource::make($Message));
    }

    public function update($lang, $id, MessageRequest $request)
    {
        $this->CheckAuth();
        $Message = Message::where('client_id', auth('sanctum')->id())->where('id', $id)->first();
        $this->CheckExist($Message);
        $Message->update($request->validated());

        return ResponseHelper::make(MessageRescource::make($Message), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id)
    {
        $this->CheckAuth();
        $Message = Message::where('client_id', auth('sanctum')->id())->where('id', $id)->delete();

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }
}
