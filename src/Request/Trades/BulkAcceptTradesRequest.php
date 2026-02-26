<?php

namespace CsFloatPhpBundle\Request\Trades;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class BulkAcceptTradesRequest extends AbstractRequest
{
    private $tradeIds;

    public function __construct(array $tradeIds)
    {
        $this->tradeIds = $tradeIds;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::POST;
    }

    public function getUrl(): string
    {
        return 'trades/bulk/accept';
    }

    public function getParams(): array
    {
        return [
            'form_params' => [
                'trade_ids' => $this->tradeIds,
            ],
        ];
    }
}
