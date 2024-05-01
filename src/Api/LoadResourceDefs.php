<?php

namespace Hsoderlind\Discogs\Api;

use InvalidArgumentException;
use RuntimeException;

class LoadResourceDefs
{
	protected array $definitions;

	public function __construct(protected readonly string $resourceName)
	{
		$resourceFile = __DIR__ . '/../resources/' . $this->resourceName . '.php';

		if (!file_exists($resourceFile)) {
			throw new InvalidArgumentException('File ' . $resourceFile . ' does not exists');
		}

		$this->definitions = require_once($resourceFile);
	}

	public function __get($name)
	{
		if (!property_exists($this, $name))
		{
			throw new RuntimeException('No property '.$name.' on '.get_class($this));
		}

		return $this->$name;
	}
}
