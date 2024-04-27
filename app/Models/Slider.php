<?php

namespace App\Models;

use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations , MediaInitialization;

    protected $fillable = array('title','description', 'link', 'sort', 'status');

    public $translatable = ['title','description'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }



    public function media()
    {
        return $this->morphMany(Media::class, 'mediale');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','image');
    }


    public function icon()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','icon');
    }

    public function getPathAttribute(){
        return 'slider';
    }




}
