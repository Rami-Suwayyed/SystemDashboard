<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Http\Resources\ProductResource;
use App\Models\About;
use Illuminate\Http\Request;


class AboutPageController extends Controller
{

    /**
     * Display a listing of the Slider
     */
    public function getAboutData(Request $request)
    {
        $result = About::active()->where('show_home',0)->orderBy('sort', 'asc')->get();
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



}
