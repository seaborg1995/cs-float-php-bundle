<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Helper\CsFloatApiConst;
use CsFloatPhpBundle\Request\AbstractRequest;
use CsFloatPhpBundle\Request\User\GetMeRequest;
use GuzzleHttp\Client;

class CsFloatApiService
{
    private $handler;

    public function __construct(string $apiKey, ?Client $client = null)
    {
        $client = $client ?? new Client(['base_uri' => CsFloatApiConst::API_V1_URL]);

        $this->handler = new RequestHandlerService($client, $apiKey);
    }

    /**
     * you can call this method with your own AbstractRequest
     * @param AbstractRequest $request
     * @return array
     */
    public function call(AbstractRequest $request): array
    {
        return $this->handler->handleApiRequest($request);
    }

    /**
     * Get current authenticated user info
     * @return array
     */
    public function getMe(): array
    {
        return $this->call(new GetMeRequest());
    }
}