<?php

use Hsoderlind\Discogs\Api\Model\Model;

return [
    // Get a release
    'getRelease' => [
        'uri' => '/releases/{release_id}',
        'method' => 'GET',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
            'curr_abbr' => [
                'type' => 'string',
                'validValues' => ['USD', 'GBP', 'EUR', 'CAD', 'AUD', 'JPY', 'CHF', 'MXN', 'BRL', 'NZD', 'SEK', 'ZAR'],
                'position' => 'query'
            ]
        ],
        'response' => Model::class
    ],

    // Retrieves the release’s rating for a given user.
    'getRating' => [
        'uri' => '/releases/{release_id}/rating/{username}',
        'method' => 'GET',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ]
        ],
        'response' => Model::class
    ],

    // Updates the release’s rating for a given user. Authentication as the user is required.
    'updateReleaseRating' => [
        'uri' => '/releases/{release_id}/rating/{username}',
        'method' => 'PUT',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'rating' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'json'
            ]
        ],
        'response' => Model::class
    ],

    // Deletes the release’s rating for a given user. Authentication as the user is required.
    'deleteRating' => [
        'uri' => '/releases/{release_id}/rating/{username}',
        'method' => 'DELETE',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
        ],
        'response' => Model::class
    ],

    // Retrieves the community release rating average and count.
    'getCommunityReleaseRating' => [
        'uri' => '/releases/{release_id}/rating',
        'method' => 'GET',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
        ],
        'response' => Model::class
    ],

    // Retrieves the release’s “have” and “want” counts.
    'getReleaseStats' => [
        'uri' => '/releases/{release_id}/stats',
        'method' => 'GET',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
        ],
        'response' => Model::class
    ]
];
