<?php

namespace App\Http\Controllers\Ajax;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Media;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function destroy($id)
    {
        $media = Media::whereId($id)->first();
        if ($media) {
            if (Storage::exists("public/" .$media->path.'/'. $media->filename)) {
                Storage::delete("public/" .$media->path.'/'. $media->filename);
            }
            $media->delete();
            return true;
        }
        return false;
    }


    public function destroyMedia($id)
    {
        $media = Media::whereId($id)->first();
        if ($media) {
            if (Storage::exists("public/" .$media->path.'/'. $media->filename)) {
                Storage::delete("public/" .$media->path.'/'. $media->filename);
            }
            $media->delete();
            return $id;
        }
        return false;
    }

}
