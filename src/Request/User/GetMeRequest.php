<?php

namespace CsFloatPhpBundle\Request\User;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class GetMeRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return 'me';
    }

    public function getParams(): array
    {
        return [];
    }
}
