<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\DeleteUserListingRequest;
use CsFloatPhpBundle\Request\GetBuyOrdersRequest;
use CsFloatPhpBundle\Request\GetInventoryRequest;
use CsFloatPhpBundle\Request\GetItemSalesGraphRequest;
use CsFloatPhpBundle\Request\GetItemLatestSalesRequest;
use CsFloatPhpBundle\Request\GetListingsRequest;
use CsFloatPhpBundle\Request\GetSimilarListingsRequest;
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

    /** return user listings */
    public function getUserListings(int $steam64Id, int $limit): array
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

    /** return global listings (search options) */
    public function getListings(
        int $limit,
        ?int $paintSeed = null,
        ?int $category = null,
        ?int $rarity = null,
        ?string $sortBy = null,
        ?float $minFloat = null,
        ?float $maxFloat = null,
        ?string $collection = null,
        ?int $minPrice = null,
        ?int $maxPrice = null,
        ?string $type = null,
        ?int $defIndex = null,
        ?int $paintIndex = null,
        ?int $minRefQty = null,
        ?int $maxRefQty = null,
        ?int $minKeychainPatter = null,
        ?int $maxKeychainPatter = null,
        ?int $minBlue = null,
        ?int $maxBlue = null,
        ?int $minFade = null,
        ?int $maxFade = null,
        ?string $stickerOptions = null,
        ?array $stickers = null,
        ?array $keychains = null
    ): array {
        return $this->call(
            new GetListingsRequest(
                $limit,
                $paintSeed,
                $category,
                $rarity,
                $sortBy,
                $minFloat,
                $maxFloat,
                $collection,
                $minPrice,
                $maxPrice,
                $type,
                $defIndex,
                $paintIndex,
                $minRefQty,
                $maxRefQty,
                $minKeychainPatter,
                $maxKeychainPatter,
                $minBlue,
                $maxBlue,
                $minFade,
                $maxFade,
                $stickerOptions,
                $stickers,
                $keychains
            )
        );
    }

    /** return list of similar listings */
    public function getSimilarListings(int $listingId): array
    {
        return $this->call(new GetSimilarListingsRequest($listingId));
    }

    /** return buy order list for particular listing */
    public function getListingBuyOrders(int $limit, int $listingId): array
    {
        return $this->call(new GetBuyOrdersRequest($limit, $listingId));
    }

    /** return latest sales for particular item  */
    public function getItemLatestSales(string $itemFullName, int $paintIndex): array
    {
        return $this->call(new GetItemLatestSalesRequest($itemFullName, $paintIndex));
    }

    /** return sales graph for particular item  */
    public function getItemSalesGraph(string $itemFullName, int $paintIndex): array
    {
        return $this->call(new GetItemSalesGraphRequest($itemFullName, $paintIndex));
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