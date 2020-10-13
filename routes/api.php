<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Stats;
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


Route::middleware('auth:api')->get('/sites2', function()
{
    return "teste";
});

// Auth Route
Route::prefix('auth')->group(function() {
    Route::post('register', 'App\Http\Controllers\AutenticatorController@register');
    Route::post('login', 'App\Http\Controllers\AutenticatorController@login');
    Route::middleware('auth:api')->group(function() {
        Route::post('logout', 'App\Http\Controllers\AutenticatorController@logout');
    });
});

Route::prefix('stats')->group(function() {

    // Get All Stats Records 
    Route::get('/', 'App\Http\Controllers\StatsController@index');
    Route::post('/add', 'App\Http\Controllers\StatsController@store');

    Route::get('/views', 'App\Http\Controllers\StatsController@views');
    Route::get('/views/:id', 'App\Http\Controllers\StatsController@view');
    Route::get('/count', 'App\Http\Controllers\StatsController@count');
    Route::get('/ctr', 'App\Http\Controllers\StatsController@ctr');

});





