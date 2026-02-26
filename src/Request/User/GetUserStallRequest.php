<?php

namespace CsFloatPhpBundle\Request\User;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class GetUserStallRequest extends AbstractRequest
{
    private $steam64Id;
    private $limit;

    public function __construct(int $steam64Id, int $limit)
    {
        $this->steam64Id = $steam64Id;
        $this->limit = $limit;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return sprintf('users/%d/stall', $this->steam64Id);
    }

    public function getParams(): array
    {
        return [
            'query' => [
                'limit' => $this->limit,
            ],
        ];
    }
}