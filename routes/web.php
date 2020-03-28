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
    Route::get('/{id}', 'NewsController@view')->where('id', '[0-9]+')->name('view');
    Route::get('/category', 'NewsController@category')->name('category');
    Route::get('/category/{name}', 'NewsController@category')->where('name', '[a-z0-9-]+')->name('category.view');
});

route::group([
    'prefix' => 'news',
    'as' => 'category.'
], function () {
    Route::get('/category', 'CategoryController@index')->name('index');
});

route::group([
    'prefix' => 'admin',
    'namespace' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/', 'AdminController@index')->name('index');
});
