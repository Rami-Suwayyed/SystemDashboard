<?php

namespace App\Models;

use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory , HasTranslations,SoftDeletes , MediaInitialization;

    protected $fillable = array('title', 'description', 'sort', 'status');

    public $translatable = ['title', 'description'];


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
        return 'about';
    }

}
