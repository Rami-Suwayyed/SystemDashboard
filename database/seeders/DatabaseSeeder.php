<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\ClientWord;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductModule;
use App\Models\ProductVideo;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
         \App\Models\User::factory(5)->create();
        $this->call(PermissionsSeeder::class);
//        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(AboutSeeder::class);

    }
}
