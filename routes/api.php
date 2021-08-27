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



Route::middleware(['auth:sanctum'])->group(function() {

    Route::get('/users/me', 'UserController@me');
    Route::apiResource('/categories', 'CategoryController')->except(['show', 'index']);
    Route::apiResource('/posts', 'PostController')->except(['show', 'index']);
    Route::apiResource('/users', 'UserController')->except(['show', 'index']);
    Route::delete('/media/{media}', 'MediaController@destroy');
    Route::apiResource('/media', 'MediaController')->except(['show', 'index']);
});

Route::post('/users/{user:phone}/auth', 'UserController@auth');

Route::apiResource('/categories', 'CategoryController')->only(['show', 'index']);
Route::apiResource('/posts', 'PostController')->only(['show', 'index']);
Route::apiResource('/users', 'UserController')->only(['show', 'index']);
Route::apiResource('/media', 'MediaController')->only(['show', 'index']);
Route::apiResource('/categories/{category}/posts', 'PostController')->only(['show', 'index']);
