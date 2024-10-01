<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingRequest;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use \Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SettingResource::make(Setting::checkSettings());
        return response()->json(['data' => $settings, 'error' => ''], 200);
    }

    // public function update(SettingRequest $request, Setting $setting)
    // {
    //     $this->authorize('update', $setting);

    //     $setting->update($request->except('image', 'favicon', '_token'));

    //     if ($request->file('logo')) {
    //         $file = $request->file('logo');
    //         $filename = Str::uuid() . $file->getClientOriginalName();
    //         $file->move(public_path('images'), $filename);
    //         $path = 'images/' . $filename;
    //         $setting->update(['logo' => $path]);
    //     }
        
    //     if ($request->file('favicon')) {
    //         $file = $request->file('favicon');
    //         $filename = Str::uuid() . $file->getClientOriginalName();
    //         $file->move(public_path('images'), $filename);
    //         $path = 'images/' . $filename;
    //         $setting->update(['favicon' => $path]);
    //     }

    //     return redirect()->route('dashboard.settings');
    // }
}
