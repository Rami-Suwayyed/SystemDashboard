<?php

namespace App\Models;

use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, MediaInitialization;

    protected $fillable =  array('filename', 'name', 'path', 'media_type', 'media_id');
    protected $appends = ["url"];

    public function mediale(){
        return $this->morphTo();
    }

    public function getUrlAttribute(){
        return config("app.url") .'storage/'. trim($this->path, "/") . "/" . $this->filename;
    }

}
