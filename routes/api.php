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

Route::get('/user', function (Request $request) {
    return 'api/getuser';
});
Route::post('/user', function (Request $request) {
    return 'api/postuser';
});
Route::patch('/user', function (Request $request) {
    return 'api/patchuser';
});
Route::delete('/user', function (Request $request) {
    return 'api/deleteuser';
});

Route::post('/qiniu/token', 'QiniuController@token');

Route::delete('/qiniu/{key}', 'QiniuController@delete');
