<?php

namespace CsFloatPhpBundle\Request\Listings;

use CsFloatPhpBundle\Helper\RequestMethodConst;
use CsFloatPhpBundle\Request\AbstractRequest;

class PostUserListingRequest extends AbstractRequest
{
    private $params;

    public function getMethod(): string
    {
        return RequestMethodConst::POST;
    }

    public function getUrl(): string
    {
        return 'listings';
    }

    public function buyNow(int $assetId, int $price): self
    {
        $this->params = [
            'asset_id' => $assetId,
            'type' => 'buy_now',
            'price' => $price,
        ];

        return $this;
    }

    public function auction(int $assetId, int $reservedPrice, int $durationDays): self
    {
        $this->params = [
            'asset_id' => $assetId,
            'type' => 'auction',
            'reserved_price' => $reservedPrice,
            'duration_days' => $durationDays,
        ];

        return $this;
    }

    public function getParams(): array
    {
        return ['form_params' => $this->params];
    }
}