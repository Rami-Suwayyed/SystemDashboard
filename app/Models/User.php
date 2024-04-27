<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , MediaInitialization;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username', // add this line
        'phone_number', // add this line
        'password',
        'status',
        'first_password',
        'lang',
        'two_factor_code',
        'two_factor_expires_at',
        'receive_emails',
        'receive_notifications',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function media()
    {
        return $this->morphMany(Media::class, 'mediale');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','image');
    }
    public function getPathAttribute(){
        return 'user';
    }





}
