<?php

namespace Database\Seeders;

use App\Models\Languages;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\UsefulLink;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $Setting= Setting::create([
            'site_name' => 'natejsoft',
            'phone_number' => '+962 515 2040',
            'address' => 'Amman-Jordan',
            'email' => 'info@NatejSoft.com',
            'main_color' => '#2c303a',
            'secondary_color' => '#899bdb',
     ]);

        Languages::create([
            'name' => 'English',
            'code' => 'en',
            'flag' => 'en.png',
            'direction' => 'ltr',
            'sort' => 1,
            'status' => 1
        ]);
        Languages::create([
            'name' => 'عربي',
            'code' => 'ar',
            'flag' => 'ar.png',
            'direction' => 'rtl',
            'sort' => 2,
            'status' => 1
        ]);

//        UsefulLink::create([
//        'setting_id' => $Setting->id,
//        'title' => ['en'=> 'Staff Link','ar'=> 'Staff Link' ],
//        'image' => '',
//        'link' => 'https://hr.natejerp.com/erp/f?p=104:9999:34875358112',
//        'sort' => 1,
//        'status' => 1
//    ]);
//
//        UsefulLink::create([
//        'setting_id' => $Setting->id,
//        'title' => ['en'=> 'Support','ar'=> 'Support' ],
//        'image' => '',
//        'link' => 'https://tk.natejerp.com/erp/f?p=108:9999:13427807729329',
//        'sort' => 2,
//        'status' => 1
//    ]);
//
//        UsefulLink::create([
//        'setting_id' => $Setting->id,
//        'title' => ['en'=> 'Careers','ar'=> 'Careers' ],
//        'image' => '',
//        'link' => 'https://japp.natejerp.com/erp/f?p=104:9999:13061195602465',
//        'sort' => 3,
//        'status' => 1
//    ]);

        Menu::create([
            'title' => ['en'=> 'Home','ar'=>  'الرئيسية' ],
            'slug' => '/',
            'sort' => 1,
            'in_footer' => 1
        ]);
        Menu::create([
            'title' => ['en'=> 'About','ar'=> 'نبذة عنا' ],
            'slug' => '/about',
            'sort' => 2,
            'in_footer' => 1
        ]);
        Menu::create([
            'title' => ['en'=> 'Product','ar'=>  'المنتجات' ],
            'slug' => '/products',
            'sort' => 3,
            'in_footer' => 1
        ]);
        Menu::create([
            'title' => ['en'=> 'Clients','ar'=> 'عملاءنا' ],
            'slug' => '/clients',
            'sort' => 4,
            'in_footer' => 1
        ]);
        Menu::create([
            'title' => ['en'=> 'Contact Us','ar'=>  'تواصل معنا' ],
            'slug' => '/contact-us',
            'sort' => 5,
            'in_footer' => 0
        ]);
        Menu::create([
            'title' => ['en'=> 'Useful link','ar'=> 'روابط مفيدة' ],
            'slug' => '',
            'sort' => 6,
            'in_footer' => 0
        ]);
    }
}
