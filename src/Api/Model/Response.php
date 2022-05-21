<?php

namespace Hsoderlind\Discogs\Api\Model;

class Response implements ResponseInterface
{
    /**
     * 
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $_response;

    public function __construct(\Psr\Http\Message\ResponseInterface $response)
    {
        $this->_response = $response;
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
}
