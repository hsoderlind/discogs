<?php

namespace Hsoderlind\Discogs\Api;

use Hsoderlind\Discogs\Client\Client;
use BadMethodCallException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use InvalidArgumentException;
use Hsoderlind\Discogs\Api\Exception\NotFoundException;
use Hsoderlind\Discogs\Api\Exception\RemoteServerErrorException;
use Psr\Http\Message\ResponseInterface;

class Service
{
	/**
	 * Caches the loaded resources
	 * 
	 * @var array
	 */
	private static $RESOURCES = [];

	/**
	 * the http client
	 *
	 * @var Client
	 */
	private $_client;

	/**
	 * The service name
	 *
	 * @var string
	 */
	private $_serviceName;

	public function __construct(Client $client, string $serviceName)
	{
		$this->_client = $client;
		$this->_serviceName = $serviceName;

		$resourceLoaded = isset(self::$RESOURCES[$serviceName]);

		if (!$resourceLoaded) {
			$this->_loadResource($serviceName);
		}
	}

	/**
	 * Load a resource
	 *
	 * @param string $serviceName
	 * @return void
	 */
	private function _loadResource(string $serviceName)
	{
		$resourceFile = __DIR__ . '/../resources/' . $serviceName . '.php';

		if (!file_exists($resourceFile)) {
			throw new InvalidArgumentException('File ' . $resourceFile . ' does not exists');
		}

		self::$RESOURCES[$serviceName] = require_once($resourceFile);
	}

	public function __call(string $name, ?array $arguments = null): mixed
	{
		if (!isset(self::$RESOURCES[$this->_serviceName][$name])) {
			throw new BadMethodCallException('No resource called ' . $name . ' in service ' . $this->_serviceName);
		}

		$definition = self::$RESOURCES[$this->_serviceName][$name];

		$resource = new Resource($name, $definition, $arguments ? $arguments[0] : null);

		$resource->validate();

		$uri = $resource->getUri(true);
		$query = $resource->getQuery();
		$json = $resource->getJson();
		$method = $resource->getMethod();
		$responseClass = $resource->getResponseClass();

		$requestOptions = [];

		if (isset($query)) {
			$requestOptions['query'] = $query;
		}

		if (isset($json)) {
			$requestOptions['json'] = $json;
		}

		try {
			$response = $this->_client->request($method, $uri, $requestOptions);
		} catch (ClientException $ex) {
			$response = $ex->getResponse();
			$json = json_decode($response->getBody());
			throw new NotFoundException($json->message);
		} catch (ServerException $ex) {
			$response = $ex->getResponse();
			$json = json_decode($response->getBody());
			throw new RemoteServerErrorException($json->message);
		}

		$this->validateResponse($response);

		return new $responseClass($response);
	}

	public function validateResponse(ResponseInterface $response): bool
	{
		$json = json_decode($response->getBody());

		if ($response->getStatusCode() === 404) {
			throw new NotFoundException($json->message);
		} elseif ($response->getStatusCode() === 500) {
			throw new RemoteServerErrorException($json->message);
		}

		return true;
	}
}
