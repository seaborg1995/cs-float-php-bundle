<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\DeleteUserListingRequest;
use CsFloatPhpBundle\Request\GetUserStallRequest;
use CsFloatPhpBundle\Request\PatchUserListingRequest;

class CsFloatListingApiService extends CsFloatApiService
{

    /**
     * this method return list of user listings
     */
    public function getStall(int $steam64Id, int $limit): array
    {
        return $this->call(new GetUserStallRequest($steam64Id, $limit));
    }

    public function delete(int $listingId): array
    {
        return $this->call(new DeleteUserListingRequest($listingId));
    }

    /**
     * @param bool $status - hide = true, unhide = false
     */
    public function setHide(int $listingId, bool $status): array
    {
        return $this->call($this->patchRequest($listingId)->hideListing($status));
    }

    public function setDescription(int $listingId, string $description): array
    {
        return $this->call($this->patchRequest($listingId)->setDescription(substr($description, 0, 32)));
    }

    public function setPrice(int $listingId, int $price): array
    {
        return $this->call($this->patchRequest($listingId)->setPrice($price));
    }

    private function patchRequest(int $listingId): PatchUserListingRequest
    {
        return new PatchUserListingRequest($listingId);
    }
}