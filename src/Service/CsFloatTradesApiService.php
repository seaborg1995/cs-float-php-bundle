<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\Trades\BulkAcceptTradesRequest;
use CsFloatPhpBundle\Request\Trades\GetTradesRequest;

class CsFloatTradesApiService extends CsFloatApiService
{
    public function getVerifiedSellerTrades(int $page, int $limit = 30): array
    {
        return $this->call(new GetTradesRequest('seller', ['verified'], $limit, $page));
    }

    public function getPendingBuyerTrades(int $page, int $limit = 30): array
    {
        return $this->call(new GetTradesRequest('buyer', ['pending'], $limit, $page));
    }

    /**
     * This request can be used to retrieve trades, available roles 'buyer', 'seller'
     * states list example ['failed','cancelled','verified','pending']
     */
    public function getTrades(string $role, array $states, int $page, int $limit): array
    {
        return $this->call(new GetTradesRequest($role, $states, $limit, $page));
    }

    /**
     * Bulk accept multiple trades at once
     * @param array $tradeIds Array of trade IDs to accept
     * @return array
     */
    public function bulkAcceptTrades(array $tradeIds): array
    {
        return $this->call(new BulkAcceptTradesRequest($tradeIds));
    }
}