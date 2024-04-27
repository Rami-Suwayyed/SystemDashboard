<?php

namespace App\Http\Controllers\Ajax;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function changeStatus(Request $request){
        try {
            switch ($request->type){
                case "user":
                case "manager":
                    $model = User::find($request->id);
                break;
                case "slider":
                    $model = Slider::find($request->id);
                break;
                case "about":
                    $model = About::find($request->id);
                break;
                case "social":
                    $model = SocialMedia::find($request->id);
                break;
                default:
                    return JsonResponse::error()->send();
                    break;
            }
            $model->status = (bool)$request->value == 1 ? 1 : 0;
            $model->save();
            return JsonResponse::success()->send();
        }catch (\Exception $exception){
            return JsonResponse::error()->send();
        }
    }

}
