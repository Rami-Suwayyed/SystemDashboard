<?php

namespace App\Models;

use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory , HasTranslations,SoftDeletes, MediaInitialization;


    protected $fillable = array('site_name', 'phone_number', 'email', 'address','main_color', 'secondary_color');

    public $translatable = ['site_name'];







    public function media()
    {
        return $this->morphMany(Media::class, 'mediale');
    }

    public function fav_icon()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','fav_icon');
    }


    public function footer_icon()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','footer_icon');
    }

    public function header_icon()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','header_icon');
    }


    public function getPathAttribute(){
        return 'setting';
    }



}
