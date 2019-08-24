<?php

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


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['auth','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function(){
    Route::get('/', function () {
        return view('welcome');
    });

        Route::group( ["prefix" => "dashboard" ] , function (){  
            Route::get('home', 'HomeController@index')->name('home');
            Route::resource('city', 'CityController');
            Route::resource('city.district','CityDistrictController');
            Route::resource('category', 'CategoryController');
            Route::resource('payment', 'PaymentController');
            Route::get('setting','SettingController@edit')->name('setting.edit');
            Route::post('setting','SettingController@store')->name('setting.store');
            //Route::resource('restaurant', 'RestaurantController');
            Route::resource('offer', 'OfferController');


        });

      

        // Route::resource('district', 'DistrictController');
        // Route::resource('client', 'ClientController');
        // Route::resource('notification', 'NotificationController');
        // Route::resource('order', 'OrderController');
        // Route::resource('product', 'ProductController');
        // Route::resource('clientrestaurant', 'ClientRestaurantController');
        // Route::resource('contact', 'ContactController');
        // Route::resource('orderproduct', 'OrderProductController');
        // Route::resource('token', 'TokenController');
        // Route::resource('categoryrestaurant', 'CategoryRestaurantController');

    });
    Auth::routes();
