<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class GetBuyOrdersRequest extends AbstractRequest
{
    private $limit;
    private $listingId;

    public function __construct(int $limit, int $listingId)
    {
        $this->limit = $limit;
        $this->listingId = $listingId;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return sprintf('listings/%d/buy-orders', $this->listingId);
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