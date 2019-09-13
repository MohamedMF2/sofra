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

        Route::group( 
            [  "middleware" => ['auth','auto-check-permission'], "prefix" => "dashboard" ] , 
            function (){  
            Route::get('home', 'HomeController@index')->name('home');
            Route::resource('city', 'CityController');
            Route::resource('city.district','CityDistrictController');
            Route::resource('category', 'CategoryController');
            Route::resource('payment', 'PaymentController');
            Route::get('setting','SettingController@edit')->name('setting.edit');
            Route::post('setting','SettingController@store')->name('setting.store');
            Route::resource('offer', 'OfferController');
            Route::resource('contact', 'ContactController');
            Route::get('restaurant/{id}/de-activate','RestaurantController@deActivate')->name('restaurant.deActive');
            Route::get('restaurant/{id}/activate','RestaurantController@activate')->name('restaurant.active');
            Route::resource('restaurant', 'RestaurantController');
            Route::get('client/{id}/de-activate','ClientController@deActivate')->name('client.deActive');
            Route::get('client/{id}/activate','ClientController@activate')->name('client.active');
            Route::resource('client', 'ClientController');
            Route::resource('order', 'OrderController');
            Route::get('change-password','AdminController@edit')->name('admin.edit');
            Route::post('change-password','AdminController@store')->name('admin.store');
            Route::resource('user','UserController');
            Route::resource('role','RoleController');
            Route::resource('permission','PermissionController');

        });

      
        // Route::resource('notification', 'NotificationController');
        // Route::resource('product', 'ProductController');

    });
    Auth::routes();
