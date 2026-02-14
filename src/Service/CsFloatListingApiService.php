<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\DeleteUserListingRequest;
use CsFloatPhpBundle\Request\GetInventoryRequest;
use CsFloatPhpBundle\Request\GetUserStallRequest;
use CsFloatPhpBundle\Request\PatchUserListingRequest;
use CsFloatPhpBundle\Request\PatchUserRequest;
use CsFloatPhpBundle\Request\PostUserListingRequest;

class CsFloatListingApiService extends CsFloatApiService
{
    /** return inventory items */
    public function getInventory(): array
    {
        return $this->call(new GetInventoryRequest());
    }

    /** list item on market as buy now */
    public function createBuyNowListing(int $assetId, int $price): array
    {
        return $this->call($this->postListingRequest()->buyNow($assetId, $price));
    }

    /** list item on market as auction */
    public function createAuctionListing(int $assetId, int $reservedPrice, int $durationDays): array
    {
        return $this->call($this->postListingRequest()->auction($assetId, $reservedPrice, $durationDays));
    }

    /** return listings */
    public function getListings(int $steam64Id, int $limit): array
    {
        return $this->call(new GetUserStallRequest($steam64Id, $limit));
    }

    /** remove listing */
    public function deleteListing(int $listingId): array
    {
        return $this->call(new DeleteUserListingRequest($listingId));
    }

    /** hide/unhide listing  */
    public function setListingPrivate(int $listingId, bool $status): array
    {
        return $this->call($this->patchListingRequest($listingId)->setPrivate($status));
    }

    /** update listing description */
    public function setListingDescription(int $listingId, string $description): array
    {
        return $this->call($this->patchListingRequest($listingId)->setDescription(substr($description, 0, 32)));
    }

    /** update listing price */
    public function setListingPrice(int $listingId, int $price): array
    {
        return $this->call($this->patchListingRequest($listingId)->setPrice($price));
    }

    /** hide all listings (away mode) */
    public function setAwayMode(bool $status): array
    {
        return $this->call($this->patchUserRequest()->setAway($status));
    }

    /** anonymize listings (privacy mode) */
    public function setStallPublic(bool $status): array
    {
        return $this->call($this->patchUserRequest()->setStallPublic($status));
    }

    private function patchListingRequest(int $listingId): PatchUserListingRequest
    {
        return new PatchUserListingRequest($listingId);
    }

    private function patchUserRequest(): PatchUserRequest
    {
        return new PatchUserRequest();
    }

    private function postListingRequest(): PostUserListingRequest
    {
        return new PostUserListingRequest();
    }
}