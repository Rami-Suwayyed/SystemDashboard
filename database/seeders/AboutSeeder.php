<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;


class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            About::create([
                'title'           => ['en'=> 'ABOUT System Dashboard','ar'=> 'ABOUT System Dashboard' ],
                'description'      => ['en'=> 'System Dashboard (System Dashboard for Information Technology) .',
                    'ar'=> 'System Dashboard (System Dashboard for Information Technology) .'
                ],
                'sort'            => 0,
                'status'          => 1,
            ]);

    }
}
