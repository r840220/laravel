<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'global'], function(){

    //首頁
    Route::get('/', [
        'uses' => 'ProductController@getIndex',
        'as' => 'ProductController.index'
    ]);

    //商品
    Route::group(['prefix' => 'product'], function (){
        Route::get('/', [
            'uses' => 'ProductController@getIndex',
            'as' => 'ProductController.index'
        ]);

        Route::post('/search', [
            'uses' => 'ProductController@postSearch',
            'as' => 'ProductController.postSearch'
        ]);

        Route::get('/page/{type}', [
            'uses' => 'ProductController@getPage',
            'as' => 'ProductController.getPage'
        ]);
    });
    //商品end

    //購物車
    Route::group(['prefix' => 'cart'], function(){
        Route::get('/add/{id}', [
            'uses' => 'ProductController@getAddToCart',
            'as' => 'ProductController.getAddToCart'
        ]);

        Route::get('/test', [
            'uses' => 'ProductController@test_cart_add',
            'as' => 'ProductController.test_cart_add'
        ]);

    });
    //購物車end

    //購買
    Route::group(['prefix' => 'sale', 'middleware' => 'auth'], function(){
        // show cart
        Route::get('/', [
            'uses' => 'SaleController@index',
            'as' => 'sale.index'
        ]);

        Route::post('/', [
            'uses' => 'SaleController@create_order',
            'as' => 'sale.create_order'
        ]);

        Route::get('/pdf', [
            'uses' => 'SaleController@create_pdf',
            'as' => 'sale.create_pdf'
        ]);
    });
    //購買end


    //會員
    Route::group(['prefix' => 'user'], function(){
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);
        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);
        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);
        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);

        Route::get('/logout',[
            'uses' => 'UserController@getLogout',
            'as'=> 'user.logout'
        ]);

        Route::get('/profile', [
            'uses' => 'UserController@profile',
            'as' => 'user.profile'
        ]);

        Route::get('/send_mail', [
            'uses' => 'UserController@send_mail',
        ]);
    });
    //會員end

    //下載資料
    Route::get('/download',[
        'uses' => 'Download@main',
        'as' => 'download'
    ]);
    //下載資料end
});



