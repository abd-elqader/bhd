<?php

namespace App\Http\Controllers\Mix;

use App\Helper\WhatsApp;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;

class webController extends Controller
{
    public function lang($locale)
    {
        app()->setLocale($locale);
        Session()->put('locale', $locale);

        return redirect()->back();
    }

    public function ip()
    {
        $data = Location::get(request()->ip());
        dd($data);
    }

    public function artisan($command)
    {
        try {
        
          Artisan::call($command, ['--force' => true ]);
        
        } catch (\Exception $e) {
        
            Artisan::call($command);
        }
        dd(Artisan::output());
    }

    public function SendOTP($number)
    {
        return response()->json([
            'code' => WhatsApp::SendOTP($number),
        ]);
    }

    public function reorder(Request $request)
    {
        $validator = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
            'positions' => 'required|array',
            'positions.*' => 'integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        }
        $positions = [];
        foreach ($request->positions as $key => $value) {
            $positions[$key] = (int) ($value);
        }
        sort($positions, SORT_NUMERIC);
        foreach ($request->ids as $index => $id) {
            DB::table($request->table)->where('id', $id)->update([
                'position' => $positions[$index],
            ]);
        }

        return response(Response::HTTP_OK);
    }

    public function switch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'column_name' => ['required', 'string'],
            'table' => ['required', 'string'],
            'value' => ['nullable', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        }

        if (Schema::hasColumn($request->table, $request->column_name)) {
            if ($request->value) {
                $check = $request->value;
            } else {
                $check = ! DB::table($request->table)->where('id', $request->id)->value($request->column_name);
            }

            DB::table($request->table)->where('id', $request->id)->update([
                $request->column_name => $check,
            ]);

            return response()->json($check);
        } else {
            return response()->json('Invalid Table');
        }
    }

    public function RemoveIds(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => ['required', 'array'],
            'table' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        }

        if (Schema::hasTable($request->table)) {
            DB::table($request->table)->whereIn('id', $request->ids)->delete();

            return response()->json([
                'msg' => __('messages.DeletedSuccessfully'),
                'isConfirmed' => 1,
            ]);
        } else {
            return response()->json('Invalid Table');
        }
    }

    public function switchTheme()
    {
        Admin::find(auth()->id())->update([
            'theme' => auth()->user()->theme == 1 ? 0 : 1,
        ]);
    }
}
