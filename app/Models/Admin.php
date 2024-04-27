<?php

namespace App\Models;

use App\Helpers\Media\Src\MediaInitialization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
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
        'password',
        'status',
        'first_password',
        'is_super_admin', // add this line
        'lang',
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




    public function role(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Role::class, RelatedRole::class, "admin_id", "id", "id", "role_id");
    }

    public function relatedRole(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RelatedRole::class);
    }


    public function isAdministrator(){
        return $this->is_super_admin;
    }


    public function media()
    {
        return $this->morphMany(Media::class, 'mediale');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediale')->where('name','image');
    }
    public function getPathAttribute(){
        return 'admin';
    }



}
