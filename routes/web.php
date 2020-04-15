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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/about', 'HomeController@about')->name('about');

route::group([
    'prefix' => 'news',
    'as' => 'news.'
], function () {
    Route::get('/', 'NewsController@index')->name('index');
    Route::get('/{news}', 'NewsController@show')->where('id', '[0-9]+')->name('show');
    Route::get('/category', 'NewsController@categories')->name('category.index');
    Route::get('/category/{slug}', 'NewsController@category')->where('slug', '[a-z0-9-]+')->name('category.view');
});

route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.'
], function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/download-json-category', 'AdminController@downloadJsonCategory')->name('downloadJsonCategory');
    Route::group([
        'prefix' => 'news',
        'as' => 'news.'
    ], function (){
        Route::get('/', 'NewsController@index')->name('index');
        Route::match(['get','post'], '/create', 'NewsController@create')->name('create');
        Route::get('/edit/{news}', 'NewsController@edit')->name('edit');
        Route::post('/update/{news}', 'NewsController@update')->name('update');
        Route::get('/destroy/{news}', 'NewsController@destroy')->name('destroy');
    });

});

Auth::routes();
