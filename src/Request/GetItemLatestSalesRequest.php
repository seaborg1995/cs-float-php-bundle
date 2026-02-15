<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class GetItemLatestSalesRequest extends AbstractRequest
{
    private $paintIndex;
    private $itemFullName;

    public function __construct(string $itemFullName, int $paintIndex)
    {
        $this->paintIndex = $paintIndex;
        $this->itemFullName = $itemFullName;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return sprintf('history/%s/sales', $this->itemFullName);
    }

    public function getParams(): array
    {
        return [
            'query' => [
                'paint_index' => $this->paintIndex,
            ],
        ];
    }
}