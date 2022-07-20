<?php

namespace Hsoderlind\Discogs\Api\Model;

use stdClass;
use Iterator;
use ArrayAccess;
use Exception;
use JsonSerializable;
use RuntimeException;

/**
 * Collection
 * 
 * @property-read Pagination $pagination
 */
class Collection implements Iterator, ArrayAccess, ResponseInterface, JsonSerializable
{
	/**
	 * @var int
	 */
	private $_pos = 0;

	/**
	 * @var array
	 */
	private $_items = [];

	/**
	 * @var Pagination
	 */
	private $_pagination;

	/**
	 * 
	 * @var \Psr\Http\Message\ResponseInterface
	 */
	private $_response;

	/**
	 * __construct
	 *
	 * @param  \Psr\Http\Message\ResponseInterface $response
	 * @param  string|null $mainProp
	 * @return void
	 */
	public function __construct(\Psr\Http\Message\ResponseInterface $response, ?string $mainProp = null)
	{
		$this->_response = $response;
		$data = $this->_response->getBody();

		if (is_array($data)) {
			$items = $data[$mainProp];
		} elseif ($data instanceof stdClass) {
			$items = json_decode(json_encode($data), true);
		} else {
			$items = json_decode($data, true);
		}

		if (!isset($mainProp)) {
			foreach ($items as $key => $item) {
				if (is_array($item) && isset($item[0])) {
					$mainProp = $key;
				}
			}
		}

		if (isset($items['pagination'])) {
			$this->_pagination = new Pagination(
				$items['pagination']['per_page'],
				$items['pagination']['items'],
				$items['pagination']['pages'],
				$items['pagination']['page'],
				$items['pagination']['urls']
			);
		}

		$this->_items = isset($items[$mainProp]) ? $items[$mainProp] : [];
	}

	/**
	 * rewind
	 * 
	 * {@inheritdoc}
	 */
	public function rewind(): void
	{
		$this->_pos = 0;
	}

	/**
	 * current
	 *
	 * {@inheritdoc}
	 * @return Model
	 */
	public function current(): Model
	{
		return $this->get($this->_pos);
	}

	/**
	 * key
	 *
	 * {@inheritdoc}
	 */
	public function key(): int
	{
		return $this->_pos;
	}

	/**
	 * next
	 *
	 * {@inheritdoc}
	 */
	public function next(): void
	{
		++$this->_pos;
	}

	/**
	 * valid
	 *
	 * {@inheritdoc}
	 */
	public function valid(): bool
	{
		return isset($this->_items[$this->_post]);
	}

	/**
	 * offsetExists
	 *
	 * {@inheritDoc}
	 */
	public function offsetExists(mixed $offset): bool
	{
		return isset($this->_items[$offset]);
	}

	/**
	 * offsetSet
	 *
	 * {@inheritDoc}
	 */
	public function offsetSet(mixed $offset, mixed $value): void
	{
		throw new Exception(self::class . ' is read-only');
	}

	/**
	 * offsetGet
	 *
	 * {@inheritDoc}
	 */
	public function offsetGet(mixed $offset): mixed
	{
		return isset($this->_items[$offset]) ? $this->get($offset) : null;
	}

	/**
	 * offsetUnset
	 *
	 * {@inheritDoc}
	 */
	public function offsetUnset(mixed $offset): void
	{
		throw new Exception(self::class . ' is read-only');
	}

	public function __get($prop)
	{
		$method = 'get' . ucfirst($prop);

		if (!method_exists(self::class, $method)) {
			throw new RuntimeException(self::class . ' do not have any property called ' . $prop);
		}

		return $this->$method();
	}

	/**
	 * getPagination
	 *
	 * @return Pagination
	 */
	public function getPagination(): Pagination
	{
		return $this->_pagination;
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
	 * get
	 * 
	 * Get the model at a specific position.
	 *
	 * @param  int $index
	 * @return Model
	 */
	public function get(int $index): Model
	{
		$item = $this->_items[$index];

		if ($this->isModel($item)) {
			return $item;
		}

		$model = new Model($this->_response);
		$model->setData($item);
		$this->_items[$index] = $model;

		return $model;
	}

	/**
	 * Get all items
	 *
	 * @return Model[]
	 */
	public function all(): array
	{
		foreach ($this->_items as $key => $value) {
			$this->get($key);
		}

		return $this->_items;
	}

	/**
	 * isModel
	 *
	 * @param  mixed $model
	 * @return bool
	 */
	public function isModel($model): bool
	{
		return $model instanceof Model;
	}

	/**
	 * Convert the collection to JSON string
	 *
	 * @return string
	 */
	public function toJson(): string
	{
		$items = $this->all();
		$json = [];

		foreach ($items as $item) {
			$json[] = $item->toJson();
		}

		return '[' . implode(',', $json) . ']';
	}

	public function jsonSerialize()
	{
		$items = $this->all();
		$array = [];

		/** @var Model $item */
		foreach ($items as $item) {
			$array[] = $item->jsonSerialize();
		}

		return $array;
	}
}
