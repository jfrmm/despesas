<?php

Route::group([
    'middleware' =>  [
        'api',
        'auth',
    ],
    'prefix' => 'api/v1',
    'namespace' => 'Modules\Account\Http\Controllers'
], function () {
    // Companies
    Route::apiResource(
        'accounts',
        'AccountController', [
            'parameters' => [
                'accounts' => 'id'
            ]
        ]
    );

    // Movements
    Route::apiResource(
        'movements',
        'MovementController', [
            'parameters' => [
                'movements' => 'id'
            ]
        ]
    );
});
