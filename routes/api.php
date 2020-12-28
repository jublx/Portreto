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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

/*
| Ce middleware est basé sur sanctum : on filtre la requête http, et si l'utilisateur est
| authentifié, alors on retourne vrai.
*/
Route::middleware('auth:sanctum')->get('/checkauth', function (Request $request) {
  return true;
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
  Auth::guard('web')->logout();
});

Route::middleware('auth:sanctum')->post('/update_user_infos', 'App\Http\Controllers\UserInformationsController@update');

Route::middleware('auth:sanctum')->get('/user_infos', 'App\Http\Controllers\UserInformationsController@index');
/*
| Routes de l'API
*/ 

Route::post('/register', 'App\Http\Controllers\AuthController@register');
