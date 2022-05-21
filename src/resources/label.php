<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
    // Get a label
    'getLabel' => [
        'uri' => '/labels/{label_id}',
        'method' => 'GET',
        'parameters' => [
            'label_id' => [
                'required' >= true,
                'type' => 'integer',
                'position' => 'uri'
            ]
        ],
        'response' => Model::class
    ],

    // Returns a list of Releases associated with the label. Accepts Pagination parameters.
    'getReleases' => [
        'uri' => '/labels/{label_id}/releases',
        'method' => 'GET',
        'parameters' => [
            'label_id' => [
                'required' >= true,
                'type' => 'integer',
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
    ]
];
