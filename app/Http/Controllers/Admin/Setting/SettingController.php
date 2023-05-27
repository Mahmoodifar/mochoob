<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use Database\Seeders\SettingSeeder;
use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Http\Requests\Admin\Setting\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        if($setting === null)
        {
            $defult = new SettingSeeder();
            $defult->run();
            $setting = Setting::first();

        }

        return view('Admin.setting.index',compact('setting'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('Admin.setting.edit',compact('setting'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting, ImageService $imageServeice)
    {
        $inputs = $request->all();



         //set logo
         if ($request->hasFile('logo'))
         {
             if (!empty($setting->logo)) {
                 $imageServeice->deleteImage($setting->logo);
             }

             $imageServeice->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
             $imageServeice->setImageName('logo');
             $result = $imageServeice->save($request->file('logo'));

             if ($result === false) {
                 return redirect()->route('admin.setting.index')->with('swal-error', 'اپلود ایکون با خطا مواجه شد');
             }

             $inputs['logo'] = $result;
         }

          //set icon
          if ($request->hasFile('icon'))
        {
            if (!empty($setting->icon)) {
                $imageServeice->deleteImage($setting->icon);
            }

            $imageServeice->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'setting');
            $imageServeice->setImageName('icon');
            $result = $imageServeice->save($request->file('icon'));

            if ($result === false) {
                return redirect()->route('admin.content.post.index')->with('swal-error', 'اپلود ایکون با خطا مواجه شد');
            }

            $inputs['icon'] = $result;
        }

        $setting->update($inputs);
        return redirect()->route('admin.setting.index')->with('swal-success', ' تنظیمات سایت شما با موفقیت اپدیت شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
