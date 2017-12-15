<?php

Route::group([
    'middleware' => [
        'api',
        'auth',
    ],
    'prefix' => 'api/v1',
    'namespace' => 'Modules\Account\Http\Controllers',
], function () {

    // Creditor/Movements
    Route::apiResource(
        'creditors.movements',
        'CreditorMovementController',
        [
            'parameters' => [
                'creditors' => 'id1',
                'movements' => 'id2',
            ],
            'only' => [
                'index',
                // 'store',
            ],
        ]
    );
    // Route::delete('creditors/{id1}/movements', 'CreditorMovementController@destroy')
    //     ->name('creditors.movements.destroy');

    // Companies
    Route::apiResource(
        'accounts',
        'AccountController', [
            'parameters' => [
                'accounts' => 'id',
            ],
        ]
    );

    // Movements
    Route::apiResource(
        'movements',
        'MovementController', [
            'parameters' => [
                'movements' => 'id',
            ],
        ]
    );
});
