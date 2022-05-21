<?php

use Hsoderlind\Discogs\Api\Model\Collection;

return [
    // Issue a search query
    'search' => [
        'uri' => '/database/search',
        'method' => 'GET',
        'parameters' => [
            'query' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'type' => [
                'type' => 'string',
                'validValues' => ['release', 'master', 'artist', 'label'],
                'position' => 'query'
            ],
            'title' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'release_title' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'credit' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'artist' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'anv' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'label' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'genre' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'style' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'country' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'year' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'format' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'catno' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'barcode' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'track' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'submitter' => [
                'type' => 'string',
                'position' => 'query'
            ],
            'contributor' => [
                'type' => 'string',
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
    ]
];
