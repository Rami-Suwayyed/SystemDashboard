<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use HasFactory;
    protected $table = 'languages';
    public $timestamps = true;

    protected $fillable = array('name', 'code', 'direction', 'flag', 'sort', 'status');


}
