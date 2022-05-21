<?php

namespace Hsoderlind\Discogs\Api\Model;

interface ResponseInterface
{
    /**
     * Get the response object
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getResponse(): \Psr\Http\Message\ResponseInterface;
}
