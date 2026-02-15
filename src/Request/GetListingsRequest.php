<?php

namespace CsFloatPhpBundle\Request;

use CsFloatPhpBundle\Helper\RequestMethodConst;

class GetListingsRequest extends AbstractRequest
{
    private $limit;
    private $minRefQty;
    private $maxRefQty;
    private $sortBy;
    private $maxPrice;
    private $minPrice;
    private $defIndex;
    private $paintIndex;
    private $minFloat;
    private $maxFloat;
    private $category;
    private $paintSeed;
    private $minFade;
    private $maxFade;
    private $stickers;
    private $keychains;
    private $stickerOptions;
    private $collection;
    private $minBlue;
    private $maxBlue;
    private $minKeychainPatter;
    private $maxKeychainPatter;
    private $rarity;
    private $type;

    public function __construct(
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
    ) {
        $this->paintSeed = $paintSeed;
        $this->category = $category;
        $this->rarity = $rarity;
        $this->limit = $limit;
        $this->sortBy = $sortBy;
        $this->minFloat = $minFloat;
        $this->maxFloat = $maxFloat;
        $this->collection = $collection;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->type = $type;
        $this->defIndex = $defIndex;
        $this->paintIndex = $paintIndex;
        $this->minRefQty = $minRefQty;
        $this->maxRefQty = $maxRefQty;
        $this->minKeychainPatter = $minKeychainPatter;
        $this->maxKeychainPatter = $maxKeychainPatter;
        $this->minBlue = $minBlue;
        $this->maxBlue = $maxBlue;
        $this->minFade = $minFade;
        $this->maxFade = $maxFade;
        $this->stickerOptions = $stickerOptions;
        $this->stickers = $stickers;
        $this->keychains = $keychains;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::GET;
    }

    public function getUrl(): string
    {
        return 'listings';
    }

    public function getParams(): array
    {
        $params = [
            'limit' => $this->limit,
            'paint_seed' => $this->paintSeed,
            'category' => $this->category,
            'rarity' => $this->rarity,
            'sort_by' => $this->sortBy,
            'min_float' => $this->minFloat,
            'max_float' => $this->maxFloat,
            'collection' => $this->collection,
            'min_price' => $this->minPrice,
            'max_price' => $this->maxPrice,
            'type' => $this->type,
            'def_index' => $this->defIndex,
            'paint_index' => $this->paintIndex,
            'min_ref_qty' => $this->minRefQty,
            'max_ref_qty' => $this->maxRefQty,
            'min_keychain_patter' => $this->minKeychainPatter,
            'max_keychain_patter' => $this->maxKeychainPatter,
            'min_blue' => $this->minBlue,
            'max_blue' => $this->maxBlue,
            'min_fade' => $this->minFade,
            'max_fade' => $this->maxFade,
            'sticker_options' => $this->stickerOptions,
            'stickers' => $this->stickers ? json_encode($this->stickers) : null,
            'keychains' => $this->keychains ? json_encode($this->keychains) : null,
        ];

        return [
            'query' => array_filter($params, function ($v) {
                return $v !== null;
            }),
        ];
    }
}