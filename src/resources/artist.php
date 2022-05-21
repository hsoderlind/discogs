<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
	// Get an artist
	'getArtist' => [
		'uri' => '/artists/{artist_id}',
		'method' => 'GET',
		'parameters' => [
			'artist_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			]
		],
		'response' => Model::class
	],

	// Get an artist’s releases
	'getReleases' => [
		'uri' => '/artists/{artist_id}/releases',
		'method' => 'GET',
		'parameters' => [
			'artist_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'sort' => [
				'type' => 'string',
				'validVlues' => ['year', 'title', 'format'],
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
	]
];
