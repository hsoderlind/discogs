<?php

namespace Hsoderlind\Discogs\Api\Model;

use RuntimeException;

/**
 * Pagination
 * 
 * @property-read int $perPage 
 * @property-read int $items
 * @property-read int $pages
 * @property-read array $urls
 */
final class Pagination
{
	/**
	 * @var int
	 */
	private $_perPage;

	/**
	 * @var int
	 */
	private $_items;

	/**
	 * @var array
	 */
	private $_urls = [];

	/**
	 * @var int
	 */
	private $_pages;

	/**
	 * @var int
	 */
	private $_page;

	/**
	 * __construct
	 *
	 * @param  int $perPage
	 * @param  int $items
	 * @param  int $pages
	 * @param  int $page
	 * @param  array $urls
	 * @return void
	 */
	public function __construct(int $perPage, int $items, int $pages, int $page, array $urls)
	{
		$this->_perPage = $perPage;
		$this->_items = $items;
		$this->_pages = $pages;
		$this->_page = $page;
		$this->_urls = $urls;
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
	 * getPerPage
	 *
	 * @return int
	 */
	public function getPerPage(): int
	{
		return $this->_perPage;
	}

	/**
	 * getItems
	 *
	 * @return int
	 */
	public function getItems(): int
	{
		return $this->_items;
	}

	/**
	 * getPages
	 *
	 * @return int
	 */
	public function getPages(): int
	{
		return $this->_pages;
	}

	/**
	 * getUrls
	 *
	 * @return array
	 */
	public function getUrls(): array
	{
		return $this->_urls;
	}

	/**
	 * Get pagination data for HTTP headers
	 *
	 * @return array
	 */
	public function toHeaders(): array
	{
		$headers = [
			'x-pagination-per-page' => $this->_perPage,
			'x-pagination-items' => $this->_items,
			'x-pagination-pages' => $this->_pages,
			'x-pagination-page' => $this->_page
		];

		return $headers;
	}

	public function toArray(): array
	{
		return [
			'per_page' => $this->_perPage,
			'pages' => $this->_pages,
			'page' => $this->_page,
			'urls' => $this->_urls,
			'items' => $this->_items
		];
	}
}
