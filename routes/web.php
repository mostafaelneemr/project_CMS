<?php

use App\Http\Controllers\backend\about\aboutController;
use App\Http\Controllers\backend\about\aboutServController;
use App\Http\Controllers\backend\blog\blogController;
use App\Http\Controllers\backend\blog\blogSliderController;
use App\Http\Controllers\backend\contact\contactSliderController;
use App\Http\Controllers\backend\about\aboutSliderController;
use App\Http\Controllers\backend\about\teamController;
use App\Http\Controllers\backend\home\helpController;
use App\Http\Controllers\backend\home\galleryController;
use App\Http\Controllers\backend\home\homeSliderController;
use App\Http\Controllers\backend\home\pageController;
use App\Http\Controllers\backend\service\serviceController;
use App\Http\Controllers\backend\service\logoController;
use App\Http\Controllers\backend\service\serviceSliderController;
use App\Http\Controllers\backend\settingsController;
use App\Http\Controllers\backend\user\RoleController;
use App\Http\Controllers\backend\user\UserController;
use App\Http\Controllers\websiteController;
use App\Http\Controllers\websiteSlugController;
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


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    Route::get('/dashboard', function() {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'home'], function () {
        Route::resource('home-slider', homeSliderController::class);
        Route::resource('help-section', helpController::class);
        Route::resource('gallery-section', galleryController::class);
        Route::resource('pages', pageController::class);
    });

     Route::group(['prefix' => 'about'], function ( ) {
        Route::resource('about-slider', aboutSliderController::class);
        Route::resource('about-section', aboutController::class);
        Route::resource('about-service', aboutServController::class);
        Route::resource('about-team', teamController::class);
    });
    
    Route::group(['prefix' => 'service'], function () {
        Route::resource('service-slider', serviceSliderController::class);
        Route::resource('service-section', serviceController::class);
        Route::resource('logo-section', logoController::class);
    });

    Route::resource('blog-section', blogController::class);
    Route::resource('blog-slider', blogSliderController::class);

    Route::resource('contact-slider', contactSliderController::class);

    Route::get('settings', [settingsController::class, 'index'])->name('settings');
    Route::patch('setting/update', [settingsController::class, 'update'])->name('settings.update');
    
    // permissions Role
    Route::resource('roles', RoleController::class);
    // users
    Route::resource('users', UserController::class);
});

Route::group(['middleware' => ['web']], function() {

    Route::get('/', [websiteController::class, 'index'])->name('home');

    Route::get('about', [websiteController::class, 'about'])->name('about');

    Route::get('service', [websiteController::class, 'service'])->name('service');
    Route::get('service/{slug}', [websiteSlugController::class, 'service'])->name('service-slug');

    Route::get('portfolio', [websiteController::class, 'portfolio'])->name('portfolio');

    Route::get('blog', [websiteController::class, 'blog'])->name('blog');
    Route::get('blog/{slug}', [websiteSlugController::class, 'blog'])->name('blog-slug');

    Route::get('contact', [websiteController::class, 'showContactForm'])->name('contact');
    Route::post('contact' , [WebsiteController::class , 'submitContactForm'])->name('contact.submit');
    
    Route::get('page/{slug}', [websiteSlugController::class, 'page'])->name('page');
});


require __DIR__.'/auth.php';

