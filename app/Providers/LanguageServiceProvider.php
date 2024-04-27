<?php

namespace App\Providers;

use App\Models\Languages;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

//        if (!Cache::has('languages')) {
//            $languages = Languages::get();
//
//            Cache::remember('languages', 3600, function () use ($languages){
//                return $languages;
//            });
//        }
//        $languages = Cache::get('languages');
    }
}
