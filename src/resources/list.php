<?php

use Hsoderlind\Discogs\Api\Model\Collection;

return [
    // Returns a User’s Lists
    'getLists' => [
        'uri' => '/users/{username}/lists',
        'method' => 'GET',
        'parameters' => [
            'username' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
        ],
        'response' => Collection::class
    ],

    // Returns items from a specified List
    'getList' => [
        'uri' => '/lists/{list_id}',
        'method' => 'GET',
        'parameters' => [
            'list_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
        ],
        'response' => Collection::class
    ]
];
