<?php

namespace CsFloatPhpBundle\Request\Listings;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class GetSimilarListingsRequest extends AbstractRequest
{
    private $listingId;

    public function __construct(int $listingId)
    {
        $this->listingId = $listingId;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return sprintf('listings/%d/similar', $this->listingId);
    }

    public function getParams(): array
    {
        return [];
    }
}