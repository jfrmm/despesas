<?php

Route::group([
    'middleware' =>  [
        'api',
        'auth',
    ],
    'prefix' => 'api/v1',
    'namespace' => 'Modules\Account\Http\Controllers'
], function () {
        Route::resource('accounts', 'AccountController');
        Route::resource('movements', 'MovementController');
});
