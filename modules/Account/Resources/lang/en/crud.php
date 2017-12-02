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
];
