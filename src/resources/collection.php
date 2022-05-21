<?php

use Hsoderlind\Discogs\Api\Model\Collection;
use Hsoderlind\Discogs\Api\Model\Model;

return [
	// Retrieve a list of folders in a user’s collection.
	'getFolders' => [
		'uri' => '/users/{username}/collection/folders',
		'method' => 'GET',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'string',
				'position' => 'uri'
			]
		],
		'response' => Collection::class
	],

	// Create a new folder in a user’s collection.
	'createFolder' => [
		'uri' => '/users/{username}/collection/folders',
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
			]
		],
		'response' => Model::class
	],

	// Retrieve metadata about a folder in a user’s collection.
	'getFolder' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}',
		'method' => 'GET',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'string',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
		],
		'response' => Model::class
	],

	// Edit a folder’s metadata. Folders 0 and 1 cannot be renamed.
	'editFolder' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}',
		'method' => 'POST',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'string',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'name' => [
				'type' => 'string',
				'position' => 'json'
			]
		],
		'response' => Model::class
	],

	// Delete a folder from a user’s collection. A folder must be empty before it can be deleted.
	'deleteFolder' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}',
		'method' => 'DELETE',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'string',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
		]
	],

	// View the user’s collection folders which contain a specified release. 
	// This will also show information about each release instance.
	'listItemsByRelease' => [
		'uri' => '/users/{username}/collection/releases/{release_id}',
		'method' => 'GET',
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

	// Returns the list of item in a folder in a user’s collection.
	'listItemsByFolder' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}/releases',
		'method' => 'GET',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'string',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'sort' => [
				'type' => 'string',
				'validValues' => ['label', 'artist', 'title', 'catno', 'format', 'rating', 'added', 'year'],
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

	// Add a release to a folder in a user’s collection.
	'addReleaseToFolder' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}/releases/{release_id}',
		'method' => 'POST',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'string',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'release_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
		],
		'response' => Model::class
	],

	// Change the rating on a release and/or move the instance to another folder.
	'editRelease' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}/releases/{release_id}/instances/{instance_id}',
		'method' => 'POST',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'release_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'instance_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'rating' => [
				'type' => 'integer',
				'position' => 'json'
			],
			'move_to_folder_id' => [
				'type' => 'integer',
				'position' => 'json',
				'aliasOf' => 'folder_id' // todo: implement in Service
			]
		],
		'response' => Model::class
	],

	// Remove an instance of a release from a user’s collection folder.
	'deleteReleaseInstance' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}/releases/{release_id}/instances/{instance_id}',
		'method' => 'DELETE',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'release_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'instance_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
		]
	],

	// Retrieve a list of user-defined collection notes fields. 
	// These fields are available on every release in the collection.
	'listCustomFields' => [
		'uri' => '/users/{username}/collection/fields',
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

	// Change the value of a notes field on a particular instance.
	'editFieldByInstance' => [
		'uri' => '/users/{username}/collection/folders/{folder_id}/releases/{release_id}/instances/{instance_id}/fields/{field_id}',
		'method' => 'POST',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'folder_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'release_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'instance_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'field_id' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
			'value' => [
				'required' => true,
				'type' => 'string',
				'position' => 'query'
			]
		],
		'response' => Model::class
	],

	// Returns the minimum, median, and maximum value of a user’s collection.
	'getCollectionValue' => [
		'uri' => '/users/{username}/collection/value',
		'method' => 'GET',
		'parameters' => [
			'username' => [
				'required' => true,
				'type' => 'integer',
				'position' => 'uri'
			],
		],
		'response' => Model::class
	]
];
