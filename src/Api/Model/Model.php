<?php

namespace Hsoderlind\Discogs\Api\Model;

use JsonSerializable;
use stdClass;

class Model implements ResponseInterface, JsonSerializable
{
	/**
	 * @var stdClass
	 */
	private $_data;

	/**
	 * 
	 * @var \Psr\Http\Message\ResponseInterface
	 */
	private $_response;

	/**
	 * __construct
	 *
	 * @param  \Psr\Http\Message\ResponseInterface $response
	 * @return void
	 */
	public function __construct(\Psr\Http\Message\ResponseInterface $response)
	{
		$this->_response = $response;
		$this->_data = new stdClass();

		$decodedJson = json_decode($this->_response->getBody());
		if (json_last_error() === JSON_ERROR_NONE) {
			$this->_data = $decodedJson;
		}
	}

	/**
	 * Get the response object
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function getResponse(): \Psr\Http\Message\ResponseInterface
	{
		return $this->_response;
	}

	/**
	 * setData
	 * 
	 * Add data to model.
	 *
	 * @param  array|stdClass $data
	 * @return void
	 */
	public function setData($data)
	{
		$this->_data = json_decode(json_encode($data));
	}

	/**
	 * __get
	 *
	 * @param  string $prop
	 * @return mixed
	 */
	public function __get(string $prop)
	{
		return isset($this->_data->$prop) ? $this->_data->$prop : null;
	}

	/**
	 * __set
	 *
	 * @param  string $prop
	 * @param  mixed $value
	 * @return void
	 */
	public function __set(string $prop, $value)
	{
		$this->_data->$prop = $value;
	}

	/**
	 * toArray
	 * 
	 * Retrieve model data as array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		return json_decode(json_encode($this->_data), true);
	}


	/**
	 * toJson
	 * 
	 * Retrieve model data as a JSON string
	 *
	 * @return string
	 */
	public function toJson(): string
	{
		if (!empty($this->_data)) {
			return json_encode($this->_data);
		}
	}

	public function jsonSerialize()
	{
		return $this->_data;
	}
}
