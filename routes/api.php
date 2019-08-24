<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::group( ["prefix" => "v1" , 'namespace' => 'Api'] , function (){
        /* ============================= General api   =============================== */
    // 
            Route::get ('restaurants' , 'MainController@restaurants') ;// all resturants
            Route::get ('districts' , 'MainController@districts') ; //all districts
            Route::get ('cities' , 'MainController@cities') ;
            Route::get ('products' , 'MainController@products') ;//all districts of certain restaurant
            Route::get ('restaurant' , 'MainController@restaurant_details') ;
            Route::post('contact-us','MainController@contact_us');
            Route::get ('about-us','MainController@about');
            Route::get('new-offers','MAinController@new_offers');
            
        /* ============================= Client  =============================== */
    Route::group( ["prefix" => "client" , 'namespace' => 'Client'] , function (){
        // Authentication cycle  Web Services (Apis)
            Route::post('register' , 'ClientController@register') ;
            Route::post('login' , 'ClientController@login') ;
            Route::post('reset-password','ClientController@reset_password');
            Route::post('new-password','ClientController@new_password');
            Route::post('profile','ClientController@profile')->middleware('auth:client');

        // Under Authentication Web Services (Apis)
    Route::group(['middleware'=>'auth:client'],function(){
        /*------- order---------*/
            Route::post('new-order','OrderController@new_order');
            Route::get('order-details','OrderController@order_datails');
            Route::get('accepted-orders','OrderController@accepted_orders');
            Route::post('accept','OrderController@accept');
            Route::post('decline','OrderController@decline');
            Route::get('previous-orders','OrderController@previous_orders');
            Route::post('make-review','ReviewController@make_review');
            Route::get('reviews','ReviewController@reviews');
        /*--------tokens--------*/
            Route::post('register-token','NotificationController@register_token');
            Route::post('remove-token','NotificationController@remove_token');
        /**------------Notifications---------- */
        Route::get('notifications','NotificationController@notifications');
        Route::get('count','NotificationController@count');
        Route::post('is-read','NotificationController@is_read');



        });
    });
        /* ============================= Restaurant =============================== */
    Route::group( ["prefix" => "restaurant" , 'namespace' => 'Restaurant'] , function (){     
        
        // Authentication cycle  Web Services (Apis)
            Route::post('register' , 'RestaurantController@register') ;
            Route::post('login' , 'RestaurantController@login') ;
            Route::post('reset-password','RestaurantController@reset_password');
            Route::post('new-password','RestaurantController@new_password');
            Route::post('profile','RestaurantController@profile')->middleware('auth:restaurant');
            Route::get('accepted-orders','OrderController@accepted_orders');

        // Under Authentication Web Services (Apis)
    Route::group(['middleware'=>'auth:restaurant'],function(){
        /* ---- Products------ */
            Route::get('accepted-orders','OrderController@accepted_orders');
            Route::get('products' , 'ProductController@index') ;
            Route::post('create-product' , 'ProductController@create') ;
            Route::post('edit-product' , 'ProductController@edit') ;
            Route::get('delete-product' , 'ProductController@destroy') ;
            
        /* ---- Offers------ */
            Route::get('offers' , 'OfferController@index') ;
            Route::post('create-offer' , 'OfferController@create') ;
            Route::post('edit-offer' , 'OfferController@edit') ;
            Route::get('delete-offer' , 'OfferController@destroy') ;

        /*--------tokens--------*/
            Route::post('register-token','NotificationController@register_token');
            Route::post('remove-token','NotificationController@remove_token');

        /*======== Orders========= */
            Route::get('new-order','OrderController@new_order');
            Route::post('accept','OrderController@accept');
            Route::post('reject','OrderController@reject');
            Route::get('accepted-orders','OrderController@accepted_orders');
            Route::post('confirm-delivery','OrderController@confirm_delivery');
            Route::get('delivered-rejected-orders','OrderController@delivered_rejected_orders');
            Route::get('commission','OrderController@commission');
            
        /**========= Commissions ===========* */
            Route::get('commission-statement','SettingController@commission_statement');
         /**------------Notifications---------- */
         Route::get('notifications','NotificationController@notifications');
         Route::get('count','NotificationController@count');
         Route::post('is-read','NotificationController@is_read');


            
        });
    });
});
