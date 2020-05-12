<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::get('/users', 'UserController@index');

Route::get('/tags/{id}', 'UserController@getTags');
Route::get('/tags', 'UserController@storeTags');
Route::post('/tagBook', 'UserController@tagBook');

Route::middleware('auth:api')->group(function() {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/user/{userId}/detail', 'UserController@show');
});
