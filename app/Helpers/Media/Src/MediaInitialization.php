<?php
namespace App\Helpers\Media\Src;


use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


trait MediaInitialization {

    public function upload($file, $directoryPath, $name){
        if($file) {
            $filename = time() . rand(0, 100000) * 35 . "." . $file->getClientOriginalExtension();
            $file->storeAs("public/".$directoryPath."/", $filename);
        }
        return $filename;
    }

    public function files(){
        return $this->morphMany(Media::class, 'mediale', 'mediale_type', 'mediale_id');
    }

    public function getMediaFiles($name = "image"){
        return $this->files()->where("name", $name)->get();
    }


    public function initizeMedia(UploadedFile $file,  $Path , $name){
        try {
            $media = new Media();
            $filename = $this->upload($file, $Path, $name);
            $media->filename = $filename;
            $media->name = $name;
            $media->path = $Path;
            return $media;
        }catch (\Exception $e){
            die($e->getMessage());
        }

    }

    /**
     * Store the uploaded file on a filesystem disk.
     *
     * @param  UploadedFile  $path
     */
    public function saveMedia(UploadedFile $file, $Path ='', $name = "name"){
        $media = $this->initizeMedia($file, $Path , $name);
        return $this->files()->save($media);
    }

    public function removeMedia($media){
        if ($media){
            $media = Media::findOrFail($media->id);
            if (Storage::exists("public/" .$media->path.'/'. $media->filename)) {
                Storage::delete("public/" .$media->path.'/'. $media->filename);
            }
            $media->delete();
        }
    }
    public function removeAllMedia($media){
        if($media instanceof \Illuminate\Database\Eloquent\Collection){
            foreach ($media as $file){
                if (Storage::exists("public/" .$file->path.'/'. $file->filename)) {
                    Storage::delete("public/" .$file->path.'/'. $file->filename);
                }
                $file->delete();
            }
        }else{
            $file = $media;
            if (Storage::exists("public/" .$file->path.'/'. $file->filename)) {
                Storage::delete("public/" .$file->path.'/'. $file->filename);
            }
            $file->delete();
        }
    }


    public function removeAllFiles($Path) : bool{
        if($Path) {
            $this->removeDir($Path);
        }
        return false;
    }


    protected function removeDir($path){
        if(is_dir($path)){
            $files = glob($path . "*" , GLOB_MARK);
            foreach($files as $file){
                $this->removeDir($file);
            }
            if(is_dir($path))
                rmdir($path);
        }elseif(is_file($path)){
            unlink($path);
        }
        return true;
    }
}
