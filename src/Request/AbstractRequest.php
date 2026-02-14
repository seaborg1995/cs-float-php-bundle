<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Exception\ResponseException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractRequest
{
    abstract public function getMethod(): string;

    abstract public function getUrl(): string;

    abstract public function getParams(): array;

    public function getResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() === 200) {
            return json_decode($response->getBody(), true);
        }

        ResponseException::invalidStatusCode((string)$response->getBody(), $response->getStatusCode());
    }
}