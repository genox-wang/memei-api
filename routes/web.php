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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return 'getUser';
});

Route::post('/user', function () {
    return 'postUser';
});

Route::get('/artisan', function () {
    $exitCode = Artisan::call('db:seed');
    return $exitCode;
});

Route::get('/eloquent', function () {
   return App\Models\Category::first()->authors()->first()->cards()->first()->photos()->first();
});
