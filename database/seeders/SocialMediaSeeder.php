<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i=0 ;$i<5  ; $i++){
            SocialMedia::create([
                'name'           => ['en'=> Str::random(),'ar'=> Str::random() ],
                'link'            => 'https://www.google.com/',
                'sort'            => rand(0,20),
                'status'          => rand(0,1),
            ]);
        }

    }
}
