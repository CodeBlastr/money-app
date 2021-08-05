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

# v1.0 API
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){

    // /api/v1/get-user
    Route::get('/get-user', 'Api\Authorized\UserController@getUser');

    // /api/v1/institution
    Route::group(['prefix' => 'institution'], function(){
        Route::get('/list', 'Api\Authorized\InstitutionController@index');
        Route::get('/linked', 'Api\Authorized\InstitutionController@linked');
        Route::post('/create', 'Api\Authorized\InstitutionController@create');
        Route::post('/relate-dym-account', 'Api\Authorized\InstitutionController@relateDymAccount');
        Route::post('/unrelate-dym-account', 'Api\Authorized\InstitutionController@unrelateDymAccount');
    });

    // /api/v1/institution
    Route::group(['prefix' => 'bank-account'], function(){
        Route::post('/create', 'Api\Authorized\BankAccountController@create');
    });

    // /api/v1/logout
    Route::post('/logout', 'Api\Guest\User\LoginController@logout');

    // /app/v1/account
    Route::group(['prefix' => 'account', 'middleware' => 'check-account'], function() {
        // /app/v1/account/
        Route::resource('/', 'Api\Authorized\AccountController');

        // /app/v1/account/test
        Route::get('/test', 'Api\Authorized\UserController@checkAccountAccess');
    });
});
