<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::create([
            'name' => 'user',
            'username' => 'user',
            'status' =>1,
            'email' => 'user@user.com',
            'email_verified_at' => Carbon::now(),
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);



    }
}
