<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
    // Request an export of your inventory as a CSV.
    'exportInventory' => [
        'uri' => '/inventory/export',
        'method' => 'POST',
        'response' => Model::class
    ],

    // Get a list of all recent exports of your inventory.
    'listInventoryExports' => [
        'uri' => '/inventory/export',
        'method' => 'GET',
        'parameters' => [
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

    // Get details about the status of an inventory export.
    'getExport' => [
        'uri' => '/inventory/export/{id}',
        'method' => 'GET',
        'parameters' => [
            'id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ]
        ],
        'response' => Model::class
    ],

    // Download the results of an inventory export.
    // todo: implement file downloading
    // 'downloadExport' => [
    //     'uri' => '/inventory/export/{id}/download',
    //     'method' => 'GET',
    //     'parameters' => [
    //         'id' => [
    //             'required' => true,
    //             'type' => 'integer',
    //             'position' => 'uri'
    //         ]
    //     ]
    // ]
];
