<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class GetTradesRequest extends AbstractRequest
{
    private $role;
    private $states;
    private $limit;
    private $page;

    public function __construct(
        string $role,
        array $states,
        int $limit,
        int $page
    ) {
        $this->role = $role;
        $this->states = $states;
        $this->limit = $limit;
        $this->page = $page;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return 'me/trades';
    }

    public function getParams(): array
    {
        return [
            'query' => [
                'limit' => $this->limit,
                'page' => $this->page,
                'role' => $this->role,
                'state' => implode(',', $this->states),
            ],
        ];
    }
}