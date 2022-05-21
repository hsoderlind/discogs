<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
	// Get a master release
	'getMaster' => [
		'uri' => '/masters/{master_id}',
		'method' => 'GET',
		'parameters' => [
			'master_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			]
		],
		'response' => Model::class
	],

	// Retrieves a list of all Releases that are versions of this master. Accepts Pagination parameters.
	'listReleaseVersions' => [
		'uri' => '/masters/{master_id}/versions',
		'method' => 'GET',
		'parameters' => [
			'master_id' => [
				'required' => true,
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
			],
			'format' => [
				'type' => 'string',
				'position' => 'query'
			],
			'label' => [
				'type' => 'string',
				'position' => 'query'
			],
			'released' => [
				'type' => 'string',
				'position' => 'query'
			],
			'country' => [
				'type' => 'string',
				'position' => 'query'
			],
			'sort' => [
				'type' => 'string',
				'validValues' => ['released', 'title', 'format', 'label', 'catno', 'country'],
				'position' => 'query'
			],
			'sort_order' => [
				'type' => 'string',
				'validValues' => ['asc', 'desc'],
				'position' => 'query'
			]
		],
		'response' => Collection::class
	]
];
