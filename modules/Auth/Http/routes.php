<?php

Route::group([
    'middleware' => [
        'api',
    ],
    'prefix' => 'api/v1/auth',
    'namespace' => 'Modules\Auth\Http\Controllers'
], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
        Route::post('me', 'AuthController@me')->name('me');
});
