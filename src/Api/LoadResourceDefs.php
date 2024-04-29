<?php

namespace Hsoderlind\Discogs\Api;

use InvalidArgumentException;

class LoadResourceDefs
{
	public function __construct(protected readonly string $resourceName)
	{
		//
	}

	public function __invoke()
	{
		$resourceFile = __DIR__ . '/../resources/' . $this->resourceName . '.php';

		if (!file_exists($resourceFile)) {
			throw new InvalidArgumentException('File ' . $resourceFile . ' does not exists');
		}

		require_once($resourceFile);
	}
}
