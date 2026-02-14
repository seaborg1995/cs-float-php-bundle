<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class GetInventoryRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return '/me/inventory';
    }

    public function getBody(): array
    {
        return [];
    }
}