<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class DeleteUserListingRequest extends AbstractRequest
{
    private $listingId;

    public function __construct(int $listingId)
    {
        $this->listingId = $listingId;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::DELETE;
    }

    public function getUrl(): string
    {
        return 'listings/' . $this->listingId;
    }

    public function getParams(): array
    {
        return [];
    }
}