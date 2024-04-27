<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class SocialMedia extends Model
{
    use HasFactory , HasTranslations,SoftDeletes;

    protected $fillable = array('name', 'icon', 'link',  'type', 'sort', 'status');

    public $translatable = ['name'];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
