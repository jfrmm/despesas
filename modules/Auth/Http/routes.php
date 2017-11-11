<?php

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/v1/auth',
    'namespace' => 'Modules\Auth\Http\Controllers'],
    function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });
