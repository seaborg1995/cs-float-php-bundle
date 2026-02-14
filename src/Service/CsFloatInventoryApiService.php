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
        $request = new PostInventoryItemRequest();

        $request->buyNow($assetId, $price);

        return $this->call($request);
    }

    public function sellAuction(int $assetId, int $reservedPrice, int $durationDays): array
    {
        $request = new PostInventoryItemRequest();

        $request->auction($assetId, $reservedPrice, $durationDays);

        return $this->call($request);
    }
}