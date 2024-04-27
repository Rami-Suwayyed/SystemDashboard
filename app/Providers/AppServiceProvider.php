<?php

namespace App\Providers;

use App\Models\Languages;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();
        // Using view composer to set following variables globally
//        $languages=  Languages::get();
//        view()->composer('*',function(View $view) use ($languages) {
//            $view->with('languages',$languages);
//        });

    }
}
