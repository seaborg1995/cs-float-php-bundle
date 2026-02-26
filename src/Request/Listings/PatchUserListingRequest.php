<?php

namespace CsFloatPhpBundle\Request\Listings;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class PatchUserListingRequest extends AbstractRequest
{
    private $listingId;
    private $params;

    public function __construct(int $listingId)
    {
        $this->listingId = $listingId;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::PATCH;
    }

    public function getUrl(): string
    {
        return 'listings/' . $this->listingId;
    }

    public function setPrivate(bool $status): self
    {
        $this->params = ['private' => $status];

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->params = ['description' => $description];

        return $this;
    }

    public function setPrice(int $price): self
    {
        $this->params = ['price' => $price];

        return $this;
    }

    public function getParams(): array
    {
        return ['form_params' => $this->params];
    }
}