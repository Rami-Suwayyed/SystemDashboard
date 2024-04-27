<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\MenuResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SocialMediaResource;
use App\Models\About;
use App\Models\Languages;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SocialMedia;
use Illuminate\Http\Request;


class HomePageController extends Controller
{



    /**
     * Display a listing of the language
     */
    public function getLanguages(Request $request)
    {
        $Languages = Languages::where('status', '=', 1)->get();

        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => LanguageResource::collection($Languages)

        ];
        return response($response, 200);
    }


    /**
     * Display a listing of the language
     */
    public function getMenu(Request $request)
    {
        $setting = Setting::first();
//        Menu::
        $data=[
            'header_menus'=>MenuResource::collection(Menu::orderBy('sort', 'asc')->get()),
            'footer_menus'=>MenuResource::collection(Menu::where('in_footer',1)->orderBy('sort', 'asc')->orderBy('sort', 'asc')->get())
        ];
        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => $data
        ];
        return response($response, 200);
    }



    /**
     * Display a listing of the Slider
     */
    public function getSliderData(Request $request)
    {
        $result = Slider::where('status', '=', 1)->orderBy('sort', 'asc')->get();
        $setting= Setting::first();
        if ($setting){
            $setting->count_visitors = $setting->count_visitors ? $setting->count_visitors + 1 : 1;
            $setting->save();
        }
        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => SliderResource::collection($result)

        ];
        return response($response, 200);
    }

    /**
     * Display a listing of the Slider
     */
    public function firstSliderData(Request $request)
    {
        $result = Slider::where('status', '=', 1)->orderBy('sort', 'asc')->first();
            $response = [
                'status' => 1,
                'message' => 'request success.',
                'data' => new SliderResource($result)

            ];

        return response($response, 200);
    }



    /**
     * Display a listing of the Slider
     */
    public function getAboutData(Request $request)
    {
        $result = About::active()->orderBy('sort', 'asc')->get();
        $response = [];
        if ($result)
        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => AboutResource::collection($result)

        ];
        return response($response, 200);
    }
    /**
     * Display a listing of the Slider
     */
    public function firstAboutData(Request $request)
    {
        $result = About::active()->where('show_home',1)->orderBy('sort', 'asc')->first();
        $response = [];
        if ($result)
        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => new AboutResource($result)

        ];
        return response($response, 200);
    }


    /**
     * Display a Settings
     */
    public function getSettings(Request $request)
    {
        $result = Setting::first();
        $response=[];
        if ($result)
        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => new SettingsResource($result)

        ];
        return response($response, 200);
    }

    /**
     * Display a Social Media
     */
    public function getSocialMediaLinks(Request $request)
    {
        $result = SocialMedia::active()->orderBy('sort', 'asc')->get();

        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => SocialMediaResource::collection($result)

        ];
        return response($response, 200);
    }



}
