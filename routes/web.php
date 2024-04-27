<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Ajax\MediaController;
use App\Http\Controllers\Ajax\ModelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['register' => false]);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:admin']

    ], function(){ //...

    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Roles Permissions
    Route::resource("/roles", RolePermissionController::class)->except("show");
    //Managers
    Route::resource("/managers", ManagerController::class)->except("show");

    Route::resource('settings',SettingController::class);
    Route::resource('sliders',SliderController::class);
    Route::resource('abouts',AboutController::class);
    Route::resource('socials',SocialMediaController::class);
    Route::resource('languages',LanguageController::class);
    Route::resource('contact_us',ContactUsController::class);

    Route::prefix("menus")->name("menus.")->group(function(){
        Route::get("/", [SettingController::class,'index_menu'])->name("index");
        Route::get("/edit/{menu}",  [SettingController::class,'edit_menu'])->name("edit");
        Route::put("/update/{menu}",  [SettingController::class,'update_menu'])->name("update");
    });
    Route::prefix("profile")->name("profile.")->group(function(){
        Route::get("/", [ProfileController::class,'index'])->name("index");
        Route::get("/edit",  [ProfileController::class,'Setting'])->name("edit");
        Route::put("/update",  [ProfileController::class,'update'])->name("update");
        Route::get("/change_password",  [ProfileController::class,'edit'])->name("change_password");
        Route::put("/change_password/update",  [ProfileController::class,'ChangePassword'])->name("change_password.update");
    });
    Route::prefix("sort")->name("sort.")->group(function(){
        Route::post("/sliders",[SliderController::class,'sort'])->name("sliders");
        Route::get("/sliders",[SliderController::class,'viewsort'])->name("view.sliders");
        Route::post("/social_media",[SocialMediaController::class,'sort'])->name("social_media");
        Route::get("/social_media",[SocialMediaController::class,'viewsort'])->name("view.social_media");
        Route::post("/languages",[LanguageController::class,'sort'])->name("languages");
        Route::get("/languages",[LanguageController::class,'viewsort'])->name("view.languages");
        Route::post("/abouts",[AboutController::class,'sort'])->name("abouts");
        Route::get("/abouts",[AboutController::class,'viewsort'])->name("view.abouts");
        Route::post("/menus",[SettingController::class,'sort'])->name("menus");
        Route::get("/menus",[SettingController::class,'viewsort'])->name("view.menus");
    });

    Route::prefix("ajax")->name("ajax.")->group(function(){
        Route::get("/change_status",[ModelController::class,'changeStatus'])->name("change_status");
        Route::get("/changes-main",[ModelController::class,'changesMain'])->name("changes-main");
        Route::delete("media/destroy/{id}",[MediaController::class,'destroyMedia'])->name("media.destroy");
    });



    Route::get("/sendemail/{id}", [ManagerController::class,'SendEmail'])->name("SendEmail");

    Route::get("/email/verification", [ManagerController::class,'VerificationEmail'])->name("VerificationEmail");
});

