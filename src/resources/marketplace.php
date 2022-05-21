<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
    // View the data associated with a listing.
    'getListing' => [
        'uri' => '/marketplace/listings/{listing_id}',
        'method' => 'GET',
        'parameters' => [
            'listing_id' => [
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

    // Edit the data associated with a listing.
    //
    // If the listing’s status is not For Sale, Draft, or Expired, it cannot be modified – only deleted. 
    // To re-list a Sold listing, a new listing must be created.
    'updateListing' => [
        'uri' => '/marketplace/listings/{listing_id}',
        'method' => 'POST',
        'parameters' => [
            'listing_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'json'
            ],
            'condition' => [
                'required' => true,
                'type' => 'string',
                'validValues' => ['Mint', 'Near Mint', 'Very Good Plus', 'Very Good', 'Good Plus', 'Good', 'Fair', 'Poor', 'M', 'NM', 'M-', 'VG+', 'VG', 'G+', 'G', 'F', 'P'],
                'position' => 'json'
            ],
            'sleeve_condition' => [
                'required' => true,
                'type' => 'string',
                'validValues' => ['Mint', 'Near Mint', 'Very Good Plus', 'Very Good', 'Good Plus', 'Good', 'Fair', 'Poor', 'Generic', 'Not Graded', 'No Cover', 'M', 'NM', 'M-', 'VG+', 'VG', 'G+', 'G', 'F', 'P'],
                'position' => 'json'
            ],
            'price' => [
                'required' => true,
                'type' => 'double',
                'position' => 'json'
            ],
            'comments' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'allow_offers' => [
                'type' => 'boolean',
                'position' => 'json'
            ],
            'status' => [
                'required' => true,
                'type' => 'string',
                'validValues' => ['For Sale', 'Draft'],
                'position' => 'json'
            ],
            'external_id' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'location' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'weight' => [
                'type' => 'double',
                'position' => 'json'
            ],
            'format_quantity' => [
                'type' => 'double',
                'position' => 'json'
            ],
        ],
        'response' => Model::class
    ],

    // Permanently remove a listing from the Marketplace.
    'deleteListing' => [
        'uri' => '/marketplace/listings/{listing_id}',
        'method' => 'DELETE',
        'parameters' => [
            'listing_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ],
        ]
    ],

    // Create a Marketplace listing.
    'createListing' => [
        'uri' => '/marketplace/listings',
        'method' => 'POST',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'json'
            ],
            'condition' => [
                'required' => true,
                'type' => 'string',
                'validValues' => ['Mint', 'Near Mint', 'Very Good Plus', 'Very Good', 'Good Plus', 'Good', 'Fair', 'Poor', 'M', 'NM', 'M-', 'VG+', 'VG', 'G+', 'G', 'F', 'P'],
                'position' => 'json'
            ],
            'sleeve_condition' => [
                'required' => true,
                'type' => 'string',
                'validValues' => ['Mint', 'Near Mint', 'Very Good Plus', 'Very Good', 'Good Plus', 'Good', 'Fair', 'Poor', 'Generic', 'Not Graded', 'No Cover', 'M', 'NM', 'M-', 'VG+', 'VG', 'G+', 'G', 'F', 'P'],
                'position' => 'json'
            ],
            'price' => [
                'required' => true,
                'type' => 'double',
                'position' => 'json'
            ],
            'comments' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'allow_offers' => [
                'type' => 'boolean',
                'position' => 'json'
            ],
            'status' => [
                'required' => true,
                'type' => 'string',
                'validValues' => ['For Sale', 'Draft'],
                'position' => 'json'
            ],
            'external_id' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'location' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'weight' => [
                'type' => 'double',
                'position' => 'json'
            ],
            'format_quantity' => [
                'type' => 'double',
                'position' => 'json'
            ],
        ],
        'response' => Model::class
    ],

    // View the data associated with an order.
    'getOrder' => [
        'uri' => '/marketplace/orders/{order_id}',
        'method' => 'GET',
        'parameters' => [
            'order_id' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
        ],
        'response' => Model::class
    ],

    // Edit the data associated with an order.
    'editOrder' => [
        'uri' => '/marketplace/orders/{order_id}',
        'method' => 'POST',
        'parameters' => [
            'order_id' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'status' => [
                'type' => 'string',
                'validValues' => ['New Order', 'Buyer Contacted', 'Invoice Sent', 'Payment Pending', 'Payment Received', 'Shipped', 'Refund Sent', 'Cancelled (Non-Paying Buyer)', 'Cancelled (Item Unavailable)', 'Cancelled (Per Buyer\'s Request)'],
                'position' => 'json'
            ],
            'shipping' => [
                'type' => 'double',
                'position' => 'json'
            ]
        ],
        'response' => Model::class
    ],

    // Returns a list of the authenticated user’s orders.
    'listOrders' => [
        'uri' => '/marketplace/orders',
        'method' => 'GET',
        'parameters' => [
            'status' => [
                'type' => 'string',
                'validValues' => ['All', 'New Order', 'Buyer Contacted', 'Invoice Sent', 'Payment Pending', 'Payment Received', 'Shipped', 'Merged', 'Order Changed', 'Refund Sent', 'Cancelled', 'Cancelled (Non-Paying Buyer)', 'Cancelled (Item Unavailable)', 'Cancelled (Per Buyer\'s Request)', 'Cancelled (Refund Received)'],
                'position' => 'query'
            ],
            'created_after' => [
                'type' => 'string', // ISO 8601 Date format
                'position' => 'query'
            ],
            'created_before' => [
                'type' => 'string', // ISO 8601 Date format
                'position' => 'query'
            ],
            'archived' => [
                'type' => 'Boolean',
                'position' => 'query'
            ],
            'sort' => [
                'type' => 'string',
                'validValues' => ['id', 'buyer', 'created', 'status', 'last_activity'],
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

    // Returns a list of the order’s messages with the most recent first.
    'listOrderMessages' => [
        'uri' => '/marketplace/orders/{order_id}/messages',
        'method' => 'GET',
        'parameters' => [
            'order_id' => [
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

    // Adds a new message to the order’s message log.
    'addOrderMessage' => [
        'uri' => '/marketplace/orders/{order_id}/messages',
        'method' => 'POST',
        'parameters' => [
            'order_id' => [
                'required' => true,
                'type' => 'string',
                'position' => 'uri'
            ],
            'message' => [
                'type' => 'string',
                'position' => 'json'
            ],
            'status' => [
                'type' => 'string',
                'validValues' => ['New Order', 'Buyer Contacted', 'Invoice Sent', 'Payment Pending', 'Payment Received', 'Shipped', 'Refund Sent', 'Cancelled (Non-Paying Buyer)', 'Cancelled (Item Unavailable)', 'Cancelled (Per Buyer\'s Request)'],
                'position' => 'json'
            ]
        ],
        'response' => Model::class
    ],

    // Get fee
    'getFee' => [
        'uri' => '/marketplace/fee/{price}',
        'method' => 'GET',
        'parameters' => [
            'price' => [
                'type' => 'double',
                'position' => 'uri'
            ]
        ],
        'response' => Model::class
    ],

    // Get fee with currency
    'getFeeWithCurrency' => [
        'uri' => '/marketplace/fee/{price}/{currency}',
        'method' => 'GET',
        'parameters' => [
            'price' => [
                'type' => 'double',
                'position' => 'uri'
            ],
            'currency' => [
                'type' => 'string',
                'validValues' => ['USD', 'GBP', 'EUR', 'CAD', 'AUD', 'JPY', 'CHF', 'MXN', 'BRL', 'NZD', 'SEK', 'ZAR'],
                'position' => 'uri'
            ]
        ],
        'response' => Model::class
    ],

    // Retrieve price suggestions for the provided Release ID. If no suggestions are available, an empty object will be returned.
    'getPriceSuggestions' => [
        'uri' => '/marketplace/price_suggestions/{release_id}',
        'method' => 'GET',
        'parameters' => [
            'release_id' => [
                'required' => true,
                'type' => 'integer',
                'position' => 'uri'
            ]
        ],
        'response' => Model::class
    ],

    // Retrieve marketplace statistics for the provided Release ID.
    'getReleaseStats' => [
        'uri' => '/marketplace/stats/{release_id}',
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
    ]
];
