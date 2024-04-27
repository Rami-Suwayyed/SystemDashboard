<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $roles_admin= new Role();
        $roles_admin->setTranslation('name', 'en', 'admin')
            ->setTranslation('name', 'ar', 'ادمن')
            ->save();

        $permissions =Permission::get();
        foreach ($permissions as $permission){
            DB::table('role_permission')->insert(
                ['role_id' => $roles_admin->id, 'permission_id' => $permission->id]
            );
        }

        $admin =  Admin::create([
            'name' => 'admin',
            'username' => 'admin',
            'status' =>1,
            'email' => 'admin@SystemDashboard.com',
            'email_verified_at' => Carbon::now(),
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        DB::table('related_roles')->insert(
            ['role_id' => $roles_admin->id, 'admin_id' => $admin->id]
        );



    }
}
