<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(SettingRequest $request)
    {
        try {

            $request->validated();
            $settings = Setting::where('id', $request->setting_id)->first();

            if ($request->hasFile('logo')) {
                $oldImage = $settings->logo;
                $image = $request->file('logo');

                if (File::exists(public_path($oldImage))) {
                    File::delete(public_path($oldImage));
                }

                $fileName = Str::uuid()->getHex() . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/imgs/' . $fileName, ['disk' => 'uploads']);
                $settings->update(['logo' => $path]);
            }
            
            if ($request->hasFile('favicon')) {
                $oldImage = $settings->favicon;
                $image = $request->file('favicon');

                if (File::exists(public_path($oldImage))) {
                    File::delete(public_path($oldImage));
                }

                $fileName = Str::uuid()->getHex() . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/imgs/' . $fileName, ['disk' => 'uploads']);
                $settings->update(['favicon' => $path]);
            }

            $settings->update($request->except(['_token', 'setting_id', 'logo', 'favicon']));
            return redirect()->back()->with('success', 'Settings updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating settings: ' . $e->getMessage());
        }
    }
}
