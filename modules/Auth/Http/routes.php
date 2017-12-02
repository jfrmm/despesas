<?php

Route::group([
    'middleware' => [
        'api',
    ],
    'prefix' => 'api/v1/auth',
    'namespace' => 'Modules\Auth\Http\Controllers'
], function () {
        Route::post('register', 'AuthController@register')->name('auth.register');
        Route::post('login', 'AuthController@login')->name('auth.login');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        Route::post('refresh', 'AuthController@refresh')->name('auth.refresh');
        Route::post('me', 'AuthController@me')->name('auth.me');
});
