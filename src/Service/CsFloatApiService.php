<?php

namespace Service;

use AbstractRequest;
use GuzzleHttp\Client;
use Helper\CsFloatApiConst;

class CsFloatApiService
{
    private $handler;

    public function __construct(string $apiKey, ?Client $client = null)
    {
        $client = $client ?? new Client([
            'base_uri' => CsFloatApiConst::API_V1_URL,
            'headers' => [
                'Authorization' => $apiKey,
            ],
        ]);

        $this->handler = new RequestHandlerService($client);
    }

    protected function call(AbstractRequest $request): array
    {
        return $this->handler->handleApiRequest($request);
    }
}