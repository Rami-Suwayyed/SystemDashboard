<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Dialog\Web\Dialog;
use App\Helpers\Dialog\Web\Types\SuccessMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = Setting::firstOrCreate();
        $data['setting'] =$setting;
        return view('admin.setting.index',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        $validated = $request->validated();
        $setting = Setting::findOrFail($id);

        $result = Setting::findOrFail($id)->update([
            'site_name'=>$request->site_name,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'email'=>$request->email,
            'main_color'=>$request->main_color,
            'secondary_color'=>$request->secondary_color,
        ]);


        //check if file exist
        if($request->hasFile('fav_icon')) {
            if ($setting->fav_icon)
                $setting->removeMedia($setting->fav_icon);
            $setting->saveMedia($request->file("fav_icon"),$setting->path,'fav_icon');
        }

        //check if file exist
        if($request->hasFile('header_icon')) {
            if ($setting->header_icon)
                $setting->removeMedia($setting->header_icon);
            $setting->saveMedia($request->file("header_icon"),$setting->path,'header_icon');
        }
        //check if file exist
        if($request->hasFile('footer_icon')) {
            if ($setting->footer_icon)
                $setting->removeMedia($setting->footer_icon);
            $setting->saveMedia($request->file("footer_icon"),$setting->path,'footer_icon');
        }

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("settings.edit",1);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function index_menu()
    {
        $data['menus'] = Menu::orderBy("sort", "asc")->get();
        return view('admin.setting.menus.index',$data);
    }

    public function edit_menu(string $id)
    {
        $data['menu'] =Menu::findOrFail($id);
        return view('admin.setting.menus.edit',$data);
    }

    public function update_menu(Request $request, string $id)
    {
        $result = Menu::findOrFail($id)->update([
            'title'=>$request->title,
        ]);

        $message = (new SuccessMessage())->title(__("updated_successfully"))
            ->body(__("the_data_has_been_updated_successfully"));
        Dialog::flashing($message);
        return redirect()->route("menus.index");
    }

    public function viewsort(Request $request)
    {
        $data['menus'] = Menu::orderBy("sort", "asc")->get();
        return view("admin.setting.menus.sort", $data);
    }

    public function sort(Request $request){

        $sort= 1;
        foreach ($request->menu as $id){
            $menu = Menu::where("id" , $id)->firstOrFail();
            if($menu->sort != $sort){
                $menu->sort = $sort;
                $menu->save();
            }
            $sort++;
        }
        $message = (new SuccessMessage())->title(__("sorted_successfully"))
            ->body(__("the_data_has_been_sorted_successfully"));
        Dialog::flashing($message);
        return redirect()->route("menus.index");
    }




}
