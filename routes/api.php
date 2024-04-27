<?php


//Middleware
use App\Http\Controllers\Api\AboutPageController;
use App\Http\Controllers\Api\ContactPageController;
use App\Http\Controllers\Api\HomePageController;
use App\Http\Middleware\CheckGeneralToken;
use Illuminate\Support\Facades\Route;
//admin
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\SettingController as AdminSettingsController;
use App\Http\Controllers\Admin\SocialMediaController as AdminSocialMediaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//
////Need General Token
Route::middleware([CheckGeneralToken::class])->group(function () {
    //Get Languages
    Route::get('/getLanguages', [HomePageController::class, 'getLanguages']);
    //Get Menu
    Route::get('/get_menu', [HomePageController::class, 'getMenu']);
    //Get Slider
    Route::get('/get_slider_data', [HomePageController::class, 'getSliderData']);
    Route::get('/single_slider_data', [HomePageController::class, 'firstSliderData']);
    //Get Socail Media
    Route::get('/get_social_media_links', [HomePageController::class, 'getSocialMediaLinks']);

    Route::get('/single_about_data', [HomePageController::class, 'firstAboutData']);
    //Get Settings
    Route::get('/get_settings', [HomePageController::class, 'getSettings']);

    //Get Product Data in AboutPage
    Route::get('/get_product_about', [AboutPageController::class, 'getProductData']);
    //Get About Data in About Page
    Route::get('/get_about', [AboutPageController::class, 'getAboutData']);

    //Store ContactUs Data
    Route::post('/contact_us', [ContactPageController::class, 'store']);
});



Route::prefix('admin')->group(function () {

    //Slider
    Route::apiResource('/slider', AdminSliderController::class);

    //About
    Route::apiResource('/about', AdminAboutController::class);

    //Settings
    Route::apiResource('/settings', AdminSettingsController::class);

    //    //Social Media
    Route::apiResource('/social_media', AdminSocialMediaController::class);



});
