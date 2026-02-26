# CS Float PHP Bundle

**CS Float PHP Bundle** is a PHP SDK for interacting with the **CSFloat Market API**, making it easier to integrate CSFloat services in your PHP projects.

## Requirements

- PHP >= 7.1
- Composer
- Guzzle 7.x

## Installation

Install via Composer:

```bash
composer require dvdx1995/cs-float-php-bundle
```

## Services

The bundle provides three main service classes:

### 1. CsFloatApiService (Base Service)

Base service for making API calls. All other services extend this class.

```php
use CsFloatPhpBundle\Service\CsFloatApiService;

$api = new CsFloatApiService('YOUR_API_KEY');
```

**Methods:**

| Method | Description | Parameters | Returns |
|--------|-------------|------------|---------|
| `call(AbstractRequest $request)` | Execute a custom request | `AbstractRequest` | `array` |
| `getMe()` | Get current authenticated user info | - | `array` |

---

### 2. CsFloatListingApiService

Extended service for managing listings, inventory, and item data.

```php
use CsFloatPhpBundle\Service\CsFloatListingApiService;

$api = new CsFloatListingApiService('YOUR_API_KEY');
```

**Methods:**

| Method | Description | Parameters | Returns |
|--------|-------------|------------|---------|
| `getInventory()` | Get authenticated user's inventory | - | `array` |
| `createBuyNowListing(int $assetId, int $price)` | List item for sale as Buy Now | `int`, `int` | `array` |
| `createAuctionListing(int $assetId, int $reservedPrice, int $durationDays)` | List item for sale as Auction | `int`, `int`, `int` | `array` |
| `getUserListings(int $steam64Id, int $limit)` | Get user's stall/listings | `int`, `int` | `array` |
| `deleteListing(int $listingId)` | Remove a listing | `int` | `array` |
| `setListingPrivate(int $listingId, bool $status)` | Hide/unhide a listing | `int`, `bool` | `array` |
| `setListingDescription(int $listingId, string $description)` | Update listing description (max 32 chars) | `int`, `string` | `array` |
| `setListingPrice(int $listingId, int $price)` | Update listing price | `int`, `int` | `array` |
| `setAwayMode(bool $status)` | Enable/disable away mode | `bool` | `array` |
| `setStallPublic(bool $status)` | Enable/disable stall privacy mode | `bool` | `array` |
| `getListings(int $limit, ...)` | Search global listings | See below | `array` |
| `getSimilarListings(int $listingId)` | Get similar listings | `int` | `array` |
| `getListingBuyOrders(int $limit, int $listingId)` | Get buy orders for a listing | `int`, `int` | `array` |
| `getItemLatestSales(string $itemFullName, int $paintIndex)` | Get latest sales for an item | `string`, `int` | `array` |
| `getItemSalesGraph(string $itemFullName, int $paintIndex)` | Get sales graph for an item | `string`, `int` | `array` |

**getListings() Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$limit` | `int` | Number of results (required) |
| `$paintSeed` | `?int` | Paint seed filter |
| `$category` | `?int` | Category filter |
| `$rarity` | `?int` | Rarity filter |
| `$sortBy` | `?string` | Sort field |
| `$minFloat` | `?float` | Minimum float value |
| `$maxFloat` | `?float` | Maximum float value |
| `$collection` | `?string` | Collection name |
| `$minPrice` | `?int` | Minimum price (in cents) |
| `$maxPrice` | `?int` | Maximum price (in cents) |
| `$type` | `?string` | Item type |
| `$defIndex` | `?int` | Definition index |
| `$paintIndex` | `?int` | Paint index |
| `$minRefQty` | `?int` | Minimum ref quantity |
| `$maxRefQty` | `?int` | Maximum ref quantity |
| `$stickerOptions` | `?string` | Sticker options |
| `$stickers` | `?array` | Array of stickers |
| `$keychains` | `?array` | Array of keychains |

---

### 3. CsFloatTradesApiService

Extended service for managing trades.

```php
use CsFloatPhpBundle\Service\CsFloatTradesApiService;

$api = new CsFloatTradesApiService('YOUR_API_KEY');
```

**Methods:**

| Method | Description | Parameters | Returns |
|--------|-------------|------------|---------|
| `getVerifiedSellerTrades(int $page, int $limit = 30)` | Get verified seller trades | `int`, `int` | `array` |
| `getPendingBuyerTrades(int $page, int $limit = 30)` | Get pending buyer trades | `int`, `int` | `array` |
| `getTrades(string $role, array $states, int $page, int $limit)` | Get trades with custom filters | `string`, `array`, `int`, `int` | `array` |
| `bulkAcceptTrades(array $tradeIds)` | Accept multiple trades at once | `array` | `array` |

**getTrades() Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$role` | `string` | 'buyer' or 'seller' |
| `$states` | `array` | Array of states: 'failed', 'cancelled', 'verified', 'pending' |
| `$page` | `int` | Page number |
| `$limit` | `int` | Results per page |

---

## Custom Requests

You can create your own custom requests by extending `AbstractRequest`:

```php
use CsFloatPhpBundle\Request\AbstractRequest;
use CsFloatPhpBundle\Helper\RequestMethodConst;

class YourCustomRequest extends AbstractRequest
{
    private $param;

    public function __construct($param)
    {
        $this->param = $param;
    }

    public function getMethod(): string
    {
        return RequestMethodConst::POST; // or GET, DELETE, PATCH
    }

    public function getUrl(): string
    {
        return 'endpoint/path';
    }

    public function getParams(): array
    {
        return [
            'query' => ['key' => 'value'],       // for GET requests
            // or
            'form_params' => ['key' => 'value'], // for POST/PATCH requests
            // or
            'body' => json_encode(['key' => 'value']),
        ];
    }
}
```

Then use it with any service:

```php
$api = new \CsFloatPhpBundle\Service\CsFloatApiService('YOUR_API_KEY');
$response = $api->call(new YourCustomRequest('value'));
```

---

## Available Request Classes

The bundle includes the following request classes that you can use directly or extend:

### User Requests
- `CsFloatPhpBundle\Request\User\GetMeRequest` - Get authenticated user info
- `CsFloatPhpBundle\Request\User\PatchUserRequest` - Update user settings (away mode, stall public)
- `CsFloatPhpBundle\Request\User\GetUserStallRequest` - Get user's stall/listings

### Inventory Requests
- `CsFloatPhpBundle\Request\Inventory\GetInventoryRequest` - Get user's inventory

### Listings Requests
- `CsFloatPhpBundle\Request\Listings\GetListingsRequest` - Search global listings
- `CsFloatPhpBundle\Request\Listings\GetSimilarListingsRequest` - Get similar listings
- `CsFloatPhpBundle\Request\Listings\PostUserListingRequest` - Create listing (buy now or auction)
- `CsFloatPhpBundle\Request\Listings\PatchUserListingRequest` - Update listing (price, description, private)
- `CsFloatPhpBundle\Request\Listings\DeleteUserListingRequest` - Delete listing

### Items Requests
- `CsFloatPhpBundle\Request\Items\GetItemLatestSalesRequest` - Get latest sales for item
- `CsFloatPhpBundle\Request\Items\GetItemSalesGraphRequest` - Get sales graph for item

### Orders Requests
- `CsFloatPhpBundle\Request\Orders\GetBuyOrdersRequest` - Get buy orders for listing

### Trades Requests
- `CsFloatPhpBundle\Request\Trades\GetTradesRequest` - Get trades
- `CsFloatPhpBundle\Request\Trades\BulkAcceptTradesRequest` - Accept multiple trades

---

## Examples

### Get User Inventory

```php
use CsFloatPhpBundle\Service\CsFloatListingApiService;

$api = new CsFloatListingApiService('YOUR_API_KEY');
$inventory = $api->getInventory();
```

### Search Listings

```php
use CsFloatPhpBundle\Service\CsFloatListingApiService;

$api = new CsFloatListingApiService('YOUR_API_KEY');
$listings = $api->getListings(
    limit: 10,
    minPrice: 100,
    maxPrice: 500,
    category: 2
);
```

### Create Buy Now Listing

```php
use CsFloatPhpBundle\Service\CsFloatListingApiService;

$api = new \CsFloatPhpBundle\Service\CsFloatApiService('YOUR_API_KEY');
$result = $api->createBuyNowListing(assetId: 12345, price: 150); // $1.50
```

### Accept Trades

```php
use CsFloatPhpBundle\Service\CsFloatTradesApiService;

$api = new CsFloatTradesApiService('YOUR_API_KEY');
$result = $api->bulkAcceptTrades(['947100664322983730', '123456789']);
```

### Get Item Sales History

```php
use CsFloatPhpBundle\Service\CsFloatListingApiService;

$api = new CsFloatListingApiService('YOUR_API_KEY');
$sales = $api->getItemLatestSales('AK-47 | Redline (Field-Tested)', 632);
```

## License 

MIT
