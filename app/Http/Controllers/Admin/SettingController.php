<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Ramsey\Collection\Set;

class SettingController extends Controller
{
    public function index()
    {
        $page_name = 'System Setting';
        $setting = Setting::find(1);
        $favicon = Setting::find(2);
        $front_logo = Setting::find(3);
        $admin_logo = Setting::find(4);

        $system_name = $setting->value;
        return view('admin.setting.update', compact('page_name', 'system_name', 'favicon', 'front_logo', 'admin_logo'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
        ]);



        $fav_setting = Setting::find(2);
        if ($request->file('favicon')) {
            @unlink(public_path('/others/', $fav_setting->value));
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension();
            $favicon = 'favicon.' . $extension;
            $file->move(public_path('/others'), $favicon);
            $fav_setting->value = $favicon;
            $fav_setting->save();
        }

        $front_logo = Setting::find(3);
        if ($request->file('front_logo')) {
            @unlink(public_path('/others/', $front_logo->value));
            $file = $request->file('front_logo');
            $extension = $file->getClientOriginalExtension();
            $frontlogo = 'front_logo.' . $extension;
            $file->move(public_path('/others'), $frontlogo);
            $front_logo->value = $frontlogo;
            $front_logo->save();
        }

        $admin_logo = Setting::find(4);
        if ($request->file('admin_logo')) {
            @unlink(public_path('/others/', $admin_logo->value));
            $file = $request->file('admin_logo');
            $extension = $file->getClientOriginalExtension();
            $adminlogo = 'admin_logo.' . $extension;
            $file->move(public_path('/others'), $adminlogo);
            $admin_logo->value = $adminlogo;
            $admin_logo->save();
        }


        $sys_setting = Setting::find(1);
        $sys_setting->value = $request->name;
        $sys_setting->save();

        return redirect()->action('Admin\SettingController@index')->with('success', 'Setting Updated Successfully');
    }
}
