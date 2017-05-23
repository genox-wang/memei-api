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

$api->version('v1', ['middleware' => 'api'],  function ($api) {
  $api->post('/cards', 'App\Http\Controllers\Api\v1\CardsController@store')->name('cards.store');
  $api->get('/cards', 'App\Http\Controllers\Api\v1\CardsController@index')->name('cards.index');
  $api->get('/cards/{id}', 'App\Http\Controllers\Api\v1\CardsController@show')->name('cards.show');
  $api->get('/cards/{id}/photos', 'App\Http\Controllers\Api\v1\CardsController@photos')->name('cards.photos');
  $api->put('/cards/{id}', 'App\Http\Controllers\Api\v1\CardsController@update')->name('cards.update');
  $api->delete('/cards/{id}', 'App\Http\Controllers\Api\v1\CardsController@delete')->name('cards.delete');

  $api->post('/categories', 'App\Http\Controllers\Api\v1\CategoriesController@store')->name('categories.store');
  $api->get('/categories', 'App\Http\Controllers\Api\v1\CategoriesController@index')->name('categories.index');
  $api->get('/categories/{id}', 'App\Http\Controllers\Api\v1\CategoriesController@show')->name('categories.show');
  $api->get('/categories/{id}/cards', 'App\Http\Controllers\Api\v1\CategoriesController@cards')->name('categories.cards');
  $api->get('/categories/{id}/authors', 'App\Http\Controllers\Api\v1\CategoriesController@authors')->name('categories.authors');
  $api->put('/categories/{id}', 'App\Http\Controllers\Api\v1\CategoriesController@update')->name('categories.update');
  $api->delete('/categories/{id}', 'App\Http\Controllers\Api\v1\CategoriesController@delete')->name('categories.delete');

  $api->post('/authors', 'App\Http\Controllers\Api\v1\AuthorsController@store')->name('authors.store');
  $api->get('/authors', 'App\Http\Controllers\Api\v1\AuthorsController@index')->name('authors.index');
  $api->get('/authors/{id}', 'App\Http\Controllers\Api\v1\AuthorsController@show')->name('authors.show');
  $api->get('/authors/{id}/cards', 'App\Http\Controllers\Api\v1\AuthorsController@cards')->name('authors.cards');
  $api->put('/authors/{id}', 'App\Http\Controllers\Api\v1\AuthorsController@update')->name('authors.update');
  $api->delete('/authors/{id}', 'App\Http\Controllers\Api\v1\AuthorsController@delete')->name('authors.delete');

  $api->post('/photos', 'App\Http\Controllers\Api\v1\PhotosController@store')->name('photos.store');
  $api->delete('/photos/{id}', 'App\Http\Controllers\Api\v1\PhotosController@delete')->name('photos.delete');

  $api->get('/photos/uptoken', 'App\Http\Controllers\Api\v1\PhotosController@uptoken')->name('photos.uptoken');
});

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
