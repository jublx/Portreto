<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
  });

  /*
  | Ce middleware est basé sur sanctum : on filtre la requête http, et si l'utilisateur est
  | authentifié, alors on retourne vrai.
  */
  Route::get('/checkauth', function (Request $request) {
    return true;
  });

  Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
  });

  Route::post('/update_user_infos', 'App\Http\Controllers\UserInformationsController@update');

  Route::get('/user_infos', 'App\Http\Controllers\UserInformationsController@index');

  Route::post('/add_contact', 'App\Http\Controllers\ContactController@add');

  Route::get('/user_contacts', 'App\Http\Controllers\UserInformationsController@contacts');
});

Route::post('/register', 'App\Http\Controllers\AuthController@register');
