<?php

namespace Hsoderlind\Discogs\Api\Exception;

use Exception;
use Throwable;

class RemoteServerErrorException extends Exception
{
	public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
	{
		parent::__construct($message, 500, $previous);
	}
}
