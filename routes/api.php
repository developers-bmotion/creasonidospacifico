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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/proyectos',function (){
   $proyectos = \App\Project::all();
   return $proyectos;
});

Route::group(['namespace'=>'Frontend'],function (){
    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->group(function () {
            // Send reset password mail
            Route::post('reset-password', 'AuthController@sendPasswordResetLink');

            // handle reset password form process
            Route::post('reset/password', 'AuthController@callResetPassword');
        });
    });
});


