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

/**
 * Главная страница.
 */
Route::get('/', function () {
    return view('index');
});

/**
 * Страница О проекте
 */
Route::get('/about', function () {
    return view('about');
});

/**
 * Главная страница новостей.
 */
Route::get('/news', function () {
    return view('news');
});

/**
 * Новость 1
 */
Route::get('/news/1', function () {
    return view('new-1');
});

/**
 * Новость 2
 */
Route::get('/news/2', function () {
    return view('new-2');
});
