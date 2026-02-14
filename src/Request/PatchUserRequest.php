<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class PatchUserRequest extends AbstractRequest
{
    private $params;

    public function getMethod(): string
    {
        return RequestMethodConst::PATCH;
    }

    public function getUrl(): string
    {
        return 'me';
    }

    public function setAway(bool $status): self
    {
        $this->params = ['away' => $status];

        return $this;
    }

    public function setStallPublic(bool $status): self
    {
        $this->params = ['stall_public' => $status];

        return $this;
    }

    public function getParams(): array
    {
        return ['form_params' => $this->params];
    }
}