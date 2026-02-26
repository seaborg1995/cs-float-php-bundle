<?php

namespace CsFloatPhpBundle\Request\Inventory;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class GetInventoryRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return 'me/inventory';
    }

    public function getParams(): array
    {
        return [];
    }
}