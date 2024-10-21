<?php

namespace App\Http\Controllers\Mix\Admin;

use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mix\Admin\StoreSettingRequest;
use App\Models\Central\DefaultTheme;
use App\Models\Setting;
use App\Models\Theme;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:settings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:settings-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:settings-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $type = false;
        $Settings = Setting::get();
        if (tenant()) {
            $defaultThemes = DefaultTheme::get();

            return view('Mix.Admin.setting.edit', compact('Settings', 'type', 'defaultThemes'));
        } else {
            return view('Mix.Admin.setting.edit', compact('Settings', 'type'));
        }
    }

    public function show($type, Request $request)
    {
        $Settings = Setting::when($type, function ($query) use ($type) {
            return $query->where('type', $type);
        })->get();
        if (tenant()) {
            $defaultThemes = DefaultTheme::get();

            return view('Mix.Admin.setting.edit', compact('Settings', 'type', 'defaultThemes'));
        } else {
            return view('Mix.Admin.setting.edit', compact('Settings', 'type'));
        }
    }

    public function create()
    {
        return view('Mix.Admin.setting.create');
    }

    public function store(StoreSettingRequest $request)
    {
        if ($request['valuetype'] == 'description') {
            Setting::create($request->validated());
        }
        if ($request['valuetype'] == 'image') {
            $imageName = Upload::UploadFile($request->file('Imagevalue'), 'settings');
            Setting::create($request->validated() + ['value' => $imageName]);
        }
        alert()->success(__('messages.addedSuccessfully'));

        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        if ($request->type == 'theme') {
            if ($request->theme) {
                Setting::where('type', 'theme')->update(['value' => $request->theme]);
            }
            alert()->success(__('messages.updatedSuccessfully'));

            return redirect()->back();
        }
        if ($request->type) {
            $settings = Setting::latest()->where('type', $request->type)->get();
        } else {
            $settings = Setting::get();
        }
        foreach ($settings as $setting) {
            if (str_contains($setting['key'], '_image') || str_contains($setting['key'], 'logo') || str_contains($setting['key'], 'watermark')) {
                if ($request->hasFile($setting['key'])) {
                    Upload::deleteImage($setting['value'], 'settings');
                    Setting::latest()->where('key', $setting['key'])->update(['value' => Upload::UploadFile($request[$setting['key']], 'settings')]);
                }
            } else {
                Setting::latest()->where('key', $setting['key'])->update(['value' => $request->get($setting['key'])]);
            }
        }
        alert()->success(__('messages.updatedSuccessfully'));

        return redirect()->back();
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        alert()->success(__('messages.DeletedSuccessfully'));

        return redirect()->back();
    }
}
