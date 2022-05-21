<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
    // Get a seller’s inventory
    'getInventory' => [
        'uri' => '/users/{username}/inventory',
        'method' => 'GET',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'status' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'sort' => [
                'type' => 'string',
                'validValues' => ['listed', 'price', 'item', 'artist', 'label', 'catno', 'audio', 'status', 'location'],
                'position' => 'query'
            ],
            'sort_order' => [
                'type' => 'string',
                'validValues' => ['asc', 'desc'],
                'position' => 'query'
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

    // Retrieve basic information about the authenticated user.
    'getIdentity' => [
        'uri' => '/oauth/identity',
        'method' => 'GET',
        'response' => Model::class
    ],

    // Retrieve a user by username.
    'getProfile' => [
        'uri' => '/users/{username}',
        'method' => 'GET',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
        ],
        'response' => Model::class
    ],

    // Edit a user’s profile data.
    'editProfile' => [
        'uri' => '/users/{username}',
        'method' => 'POST',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'name' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'home_page' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'location' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'profile' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'curr_abbr' => [
                'type' => 'string',
                'validValues' => ['USD', 'GBP', 'EUR', 'CAD', 'AUD', 'JPY', 'CHF', 'MXN', 'BRL', 'NZD', 'SEK', 'ZAR'],
                'position' => 'json'
            ]
        ],
        'response' => Model::class
    ],

    // Retrieve a user’s submissions by username
    'getSubmissions' => [
        'uri' => '/users/{username}/submissions',
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

    // /users/{username}/contributions
    'getContributions' => [
        'uri' => '/users/{username}/contributions',
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
            ],
            'sort' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'sort_order' => [
                'type' => 'string',
                'validValues' => ['asc', 'desc'],
                'position' => 'query'
            ]
        ],
        'response' => Collection::class
    ],
];
