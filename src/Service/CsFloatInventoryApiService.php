<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\GetInventoryRequest;
use CsFloatPhpBundle\Request\PostInventoryItemRequest;

class CsFloatInventoryApiService extends CsFloatApiService
{

    /** This method returns current inventory on your account */
    public function getInventory(): array
    {
        return $this->call(
            new GetInventoryRequest()
        );
    }

    /** This method list your inventory item on market with buy now method */
    public function sellBuyNow(int $assetId, int $price): array
    {
        return $this->call($this->postItemRequest()->buyNow($assetId, $price));
    }

    /** This method list your inventory item on market with auction method */
    public function sellAuction(int $assetId, int $reservedPrice, int $durationDays): array
    {
        return $this->call($this->postItemRequest()->auction($assetId, $reservedPrice, $durationDays));
    }

    private function postItemRequest(): PostInventoryItemRequest
    {
        return new PostInventoryItemRequest();
    }
}