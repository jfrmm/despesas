<?php

return [
    'account' => [
        'indexed' => 'Accounts indexed.',
        'created' => 'Account created.',
        'read' => 'Account read.',
        'updated' => 'Account updated.',
        'deleted' => 'Account deleted.',
        'error' => [
            'creating' => 'Sorry, an error occurred while trying to create the account.',
            'reading' => 'Sorry, an error occurred while trying to read the account.',
            'updating' => 'Sorry, an error occurred while trying to update the account.',
            'deleting' => 'Sorry, an error occurred while trying to delete the account.',
            'not_found' => 'Sorry, the account was not found.',
        ],
        'relationship' => [
            'indexed' => 'Account\'s relationship items indexed.',
            'created' => 'Attached to account.',
            'deleted' => 'Detached from account.',
            'not_found' => 'Relationship not found.',
            'error' => [
                'creating' => 'Sorry, an error ocurred while trying to attach to the account.',
                'deleting' => 'Sorry, an error ocurred while trying to detach from the account.',
                'not_found' => 'Sorry, the account\'s relationship items were not found.',
            ],
        ],
    ],
    'movement' => [
        'indexed' => 'Accounts indexed.',
        'created' => 'Movement created.',
        'read' => 'Movement read.',
        'updated' => 'Movement updated.',
        'deleted' => 'Movement deleted.',
        'error' => [
            'creating' => 'Sorry, an error occurred while trying to create the movement.',
            'reading' => 'Sorry, an error occurred while trying to read the movement.',
            'updating' => 'Sorry, an error occurred while trying to update the movement.',
            'deleting' => 'Sorry, an error occurred while trying to delete the movement.',
            'not_found' => 'Sorry, the movement was not found.',
        ],
        'relationship' => [
            'indexed' => 'Movements\'s relationship items indexed.',
            'created' => 'Attached to movement.',
            'deleted' => 'Detached from movement.',
            'not_found' => 'Relationship not found.',
            'error' => [
                'creating' => 'Sorry, an error ocurred while trying to attach to the movement.',
                'deleting' => 'Sorry, an error ocurred while trying to detach from the movement.',
                'not_found' => 'Sorry, the movement\'s relationship items were not found.',
            ],
        ],
    ],
];
