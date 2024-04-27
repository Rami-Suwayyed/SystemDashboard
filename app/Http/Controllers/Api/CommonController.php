<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SocialMediaResource;
use App\Models\Languages;
use App\Models\Roles;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{

    /**
     * Display a listing of the roles
     */
    public function getRoles(Request $request)
    {
       $roles = Roles::select('id','name')->get();

        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => $roles

        ];
        return response($response, 200);
    }

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
     * Get Failed Process
     */
    public function getFailedProcess()
    {
        $response = [
            'status' => 0,
            'message' => 'process failed.',
            'data' => false

        ];

        return $response;
    }

    /**
     * Upload Files to server by form data
     */
    public function uploadFile(Request $request)
    {
        try {
            if ($request->file('file')) {
                $path = $request->file('file')->store('public');
                $storageName = basename($path);
                $response = [
                    'status' => 1,
                    'message' => 'request success.',
                    'data' => $storageName

                ];

                return response($response, 200);
            } else {
                $response = app('App\Http\Controllers\General\CommonController')->getFailedProcess();

                return response($response, 401);
            }
        } catch (\Exception $e) {
            $response = app('App\Http\Controllers\General\CommonController')->getFailedProcess();

            return response($response, 401);
        }
    }

    /**
     * Upload Files to server
     */
    public function uploadFileBase64(Request $request)
    {
        try {
            if ($request->base64) {

                $image = $request->base64;  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace('data:image/jpg;base64,', '', $image);
                $image = str_replace('data:image/jpeg;base64,', '', $image);

                $image = str_replace(' ', '+', $image);
                $imageNameWithoutExt = rand(100000000000000, 999999999999999);

                $imageName = $imageNameWithoutExt . '.png';
                $imageNameThumb = $imageNameWithoutExt . '_thumb.png';

                Storage::disk('public')->put($imageName, base64_decode($image));
                /*$storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
                Image::make(Storage::disk('public')->get($imageName))->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($storagePath . "/" . $imageNameThumb);*/

                $response = [
                    'status' => 1,
                    'message' => 'request success.',
                    'data' => $imageName,
                    'data_thumb' => $imageNameThumb

                ];

                return response($response, 200);
            } else {
                $response = app('App\Http\Controllers\General\CommonController')->getFailedProcess();

                return response($response, 401);
            }
        } catch (\Exception $e) {
            $response = app('App\Http\Controllers\General\CommonController')->getFailedProcess();

            return response($response, 401);
        }
    }



    /**
     * Display a listing of the Slider
     */
    public function getSliderData(Request $request)
    {
        $result = Slider::where('status', '=', 1)->orderBy('sort', 'asc')->get();

        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => SliderResource::collection($result)

        ];
        return response($response, 200);
    }

    /**
     * Display a listing of the News
     */


    /**
     * Display a Settings
     */
    public function getSettings(Request $request)
    {
        $result = Setting::first();

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
        $result = SocialMedia::where('status', '=', 1)->orderBy('sort', 'asc')->get();

        $response = [
            'status' => 1,
            'message' => 'request success.',
            'data' => SocialMediaResource::collection($result)

        ];
        return response($response, 200);
    }



}
