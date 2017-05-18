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

// Route::get('/user', function (Request $request) {
//     return 'api/getuser';
// });
// Route::post('/user', function (Request $request) {
//     return 'api/postuser';
// });
// Route::patch('/user', function (Request $request) {
//     return 'api/patchuser';
// });
// Route::delete('/user', function (Request $request) {
//     return 'api/deleteuser';
// });

Route::post('/qiniu/token', 'QiniuController@token');

Route::delete('/qiniu/{key}', 'QiniuController@delete');


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
  $api->get('/index', 'App\Http\Controllers\Api\DingoTest\v1\UserController@index');
});

$api->version('v2', function ($api) {
  $api->get('/user', 'App\Http\Controllers\Api\DingoTest\v2\UserController@index');
  $api->get('/user/{id}', 'App\Http\Controllers\Api\DingoTest\v2\UserController@show');
  $api->get('/paginate', 'App\Http\Controllers\Api\DingoTest\v2\UserController@paginate');
  $api->get('/array', 'App\Http\Controllers\Api\DingoTest\v2\UserController@array');
  $api->get('/error404', 'App\Http\Controllers\Api\DingoTest\v2\UserController@error404');
  $api->get('/notfound', 'App\Http\Controllers\Api\DingoTest\v2\UserController@notfound');
  $api->get('/badrequest', 'App\Http\Controllers\Api\DingoTest\v2\UserController@badrequest');
  $api->get('/forbidden', 'App\Http\Controllers\Api\DingoTest\v2\UserController@forbidden');
  $api->get('/internal', 'App\Http\Controllers\Api\DingoTest\v2\UserController@internal');
  $api->get('/internal', 'App\Http\Controllers\Api\DingoTest\v2\UserController@internal');
  $api->get('/unauthorized', 'App\Http\Controllers\Api\DingoTest\v2\UserController@Unauthorized');
});
