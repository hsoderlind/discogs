<?php

namespace Hsoderlind\Discogs\Api;

use Hsoderlind\Discogs\Exceptions\InvalidParameterTypeException;
use Hsoderlind\Discogs\Exceptions\InvalidParameterValueException;
use Hsoderlind\Discogs\Exceptions\RequiredParameterException;

class Resource
{
	/**
	 * The available resources.
	 */
	const RESOURCE_ARTIST       =   'artist';
	const RESOURCE_COLLECTION   =   'collection';
	const RESOURCE_INVENTORY    =   'inventory';
	const RESOURCE_LABEL        =   'label';
	const RESOURCE_LIST         =   'list';
	const RESOURCE_MARKETPLACE  =   'marketplace';
	const RESOURCE_MASTER       =   'master';
	const RESOURCE_RELEASE      =   'release';
	const RESOURCE_SEARCH       =   'search';
	const RESOURCE_USER         =   'user';
	const RESOURCE_WANTLIST     =   'wantlist';

	/**
	 * @var string
	 */
	private $_uri;

	/**
	 * @var string
	 */
	private $_method;

	/**
	 * @var array
	 */
	private $_parameters;

	/**
	 * @var string
	 */
	private $_response;

	/**
	 * @var array
	 */
	private $_paramValues;

	/**
	 * Class constructor
	 *
	 * @param string $name name of the service
	 * @param array $definition service definition
	 * @param array|null $paramValues parameter values
	 */
	public function __construct(string $name, array $definition, ?array $paramValues = null)
	{
		// todo: validate the $defintion. Make sure that all necessary propeties is there.
		$this->_name = $name;
		$this->_uri = $definition['uri'];
		$this->_method = $definition['method'];
		$this->_parameters = isset($definition['parameters']) ? $definition['parameters'] : null;
		$this->_response = $definition['response'];
		$this->_paramValues = $paramValues;
	}

	/**
	 * Validate parameter values
	 *
	 * @throws RequiredParameterException
	 * @throws InvalidParameterTypeException
	 * @throws InvalidParameterValueException
	 * @return boolean
	 */
	public function validate(): bool
	{
		if (!isset($this->_parameters)) {
			return true;
		}

		if (!count($this->_parameters)) {
			return true;
		}

		foreach ($this->_parameters as $key => $param) {
			if (!isset($this->_paramValues[$key])) {
				continue;
			}

			$paramValue = $this->_paramValues[$key];

			if (isset($param['required']) && $param['required'] === true && !isset($paramValue)) {
				throw new RequiredParameterException($key);
			}

			if (isset($paramValue) && isset($param['type']) && !$this->ensureType($param['type'], $paramValue)) {
				throw new InvalidParameterTypeException($key . ' must be of type ' . $param['type'] . ', ' . gettype($paramValue . ' given') . ' given.');
			}

			if (isset($param['validValues']) && isset($paramValue) && !in_array($paramValue, $param['validValues'])) {
				throw new InvalidParameterValueException($key . ' except the following ' . implode(', ', $param['validValues']) . '. ' . $paramValue . ' given.');
			}
		}

		return true;
	}

	/**
	 * Check if $value is of type $type
	 *
	 * @param string $type
	 * @param mixed $value
	 * @return boolean
	 */
	public function ensureType(string $type, mixed $value): bool
	{
		switch ($type) {
			case 'boolean':
				return is_bool($value);
			case 'integer':
				return is_int($value);
			case 'double':
				return is_double($value);
			case 'string':
				return is_string($value);
		}

		return false;
	}

	/**
	 * Get the service uri
	 *
	 * @param boolean $format if true then the uri is formatted before it is returned
	 * @return string
	 */
	public function getUri(bool $format): string
	{
		return $format ? $this->_formatUri() : $this->_uri;
	}

	/**
	 * Replace all parameter placeholders in the uri with the actual values passed to the class contructor.
	 *
	 * @return string
	 */
	private function _formatUri(): string
	{
		$uri = $this->_uri;

		if (isset($this->_parameters)) {
			$uriParameters = array_filter($this->_parameters, function ($parameter) {
				return $parameter['position'] == 'uri';
			});
		}

		if (!isset($uriParameters) || !count($uriParameters)) {
			return $uri;
		}

		foreach (array_keys($uriParameters) as $key) {
			$uri = str_replace('{' . $key . '}', $this->_paramValues[$key], $uri);
		}

		return $uri;
	}

	/**
	 * Get service's query if any
	 *
	 * @return array|null
	 */
	public function getQuery(): ?array
	{
		if (isset($this->_parameters)) {
			$queryParameters = array_filter($this->_parameters, function ($parameter) {
				return $parameter['position'] == 'query';
			});
		}

		if (!isset($queryParameters) || !count($queryParameters)) {
			return null;
		}

		$query = [];
		foreach (array_keys($queryParameters) as $key) {
			if (isset($this->_paramValues[$key])) {
				$query[$key] = $this->_paramValues[$key];
			}
		}

		return $query;
	}

	/**
	 * Get service's JSON data if any
	 *
	 * @return array|null
	 */
	public function getJson(): ?array
	{
		if (isset($this->_parameters)) {
			$jsonParameters = array_filter($this->_parameters, function ($parameter) {
				return $parameter['position'] == 'json';
			});
		}

		if (!isset($jsonParameters) || !count($jsonParameters)) {
			return null;
		}

		$json = [];
		foreach (array_keys($jsonParameters) as $key) {
			if (isset($this->_paramValues[$key])) {
				$json[$key] = $this->_paramValues[$key];
			}
		}

		return $json;
	}

	/**
	 * Get the service's request method
	 *
	 * @return string
	 */
	public function getMethod(): string
	{
		return $this->_method;
	}

	/**
	 * Get the name of class handling the data we got in response from making the request.
	 *
	 * @return string
	 */
	public function getResponseClass(): string
	{
		return isset($this->_response) ? $this->_response : Response::class;
	}
}
