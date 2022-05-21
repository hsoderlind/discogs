<?php

use Hsoderlind\Discogs\Api\Model\Collection;

return [
    // Returns the list of releases in a user’s wantlist.
    'listItems' => [
        'uri' => '/users/{username}/wants',
        'method' => 'GET',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'page' => [
                'type' => 'integer',
                'position' => 'query'
            ],
            'per_page' => [
                'type' => 'integer',
                'position' => 'query'
            ]
        ],
        'response' => Collection::class
    ],

    // Add a release to a user’s wantlist.
    'addRelease' => [
        'uri' => '/users/{username}/wants/{release_id}',
        'method' => 'PUT',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
            'notes' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'rating' => [
                'type' => 'integer',
                'position' => 'query'
            ]
        ],
        'response' => Collection::class
    ],

    // Remove a release from user's wantlist
    'deleteRelease' => [
        'uri' => '/users/{username}/wants/{release_id}',
        'method' => 'DELETE',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
        ]
    ]
];
