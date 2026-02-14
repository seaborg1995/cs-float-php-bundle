# CS Float PHP Bundle

**CS Float PHP Bundle** is a PHP SDK for interacting with the **CSFloat Market API**, making it easier to integrate CSFloat services in your PHP projects.

## Requirements

- PHP >= 7.1
- Composer
- Guzzle 7.x

## Installation

Install via Composer:

`
composer require dvdx1995/cs-float-php-bundle
`

## Usage

```php
<?php

use CsFloatPhpBundle\Service\CsFloatListingApiService;

// Create the API service with your API key
$apiKey = 'YOUR_API_KEY';
$apiService = new CsFloatListingApiService($apiKey);

// Get your inventory items
$inventoryItems = $apiService->getInventory();

foreach ($inventoryItems as $item) {
    // Work with each inventory item
    // Example: list items for Buy Now or Auction

    $assetId = $item['id']; // example
    $price = 100 // 1$

    // Sell the item as Buy Now
    $apiService->createBuyNowListing($assetId, $price);

    // Sell the item via Auction
    $reservedPrice = 80 // 80 cents;
    $durationDays = 3;
    $apiService->createAuctionListing($assetId, $reservedPrice, $durationDays);
}

// You can also create your own custom request extending AbstractRequest
use CsFloatPhpBundle\Request\AbstractRequest;

class YourRequest extends AbstractRequest
{
    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return 'some url';
    }

    public function getParams(): array
    {
        return [
            'form_params' => [
                'some value' => 'abc',
            ],
        ];
    }
}

// Create the API service with your API key
$apiKey = 'YOUR_API_KEY';
$apiService = new CsFloatApiService($apiKey);

$apiService->call(new YourRequest())
```





