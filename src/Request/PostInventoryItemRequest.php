<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class PostInventoryItemRequest extends AbstractRequest
{
    private $body;

    public function getMethod(): string
    {
        return RequestMethodConst::POST;
    }

    public function getUrl(): string
    {
        return '/listings';
    }

    public function buyNow(int $assetId, int $price)
    {
        $this->body = [
            'asset_id' => $assetId,
            'type' => 'buy_now',
            'price' => $price,
        ];
    }

    public function auction(int $assetId, int $reservedPrice, int $durationDays)
    {
        $this->body = [
            'asset_id' => $assetId,
            'type' => 'auction',
            'reserved_price' => $reservedPrice,
            'duration_days' => $durationDays,
        ];
    }

    public function getBody(): array
    {
        return ['body' => $this->body];
    }
}