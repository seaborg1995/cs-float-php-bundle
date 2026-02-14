<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\AbstractRequest;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class RequestHandlerService
{
    private $client;
    private $apiKey;

    public function __construct(ClientInterface $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function handleApiRequest(AbstractRequest $request)
    {
        $headers = [
            'accept' => 'application/json, text/plain, */*',
            'cache-control' => 'no-cache',
            'pragma' => 'no-cache',
            'priority' => 'u=1, i',
            'sec-ch-ua' => '"Not)A;Brand";v="8", "Chromium";v="138", "Google Chrome";v="138"',
            'sec-ch-ua-mobile' => '?0',
            'sec-ch-ua-platform' => '"Windows"',
            'sec-fetch-dest' => 'empty',
            'sec-fetch-mode' => 'cors',
            'sec-fetch-site' => 'same-origin',
            'Authorization' => $this->apiKey,
        ];

        $promise = $this->client->requestAsync(
            $request->getMethod(),
            $request->getUrl(),
            array_merge(['headers' => $headers], $request->getParams())
        )->then(
            function (ResponseInterface $response) use ($request) {
                return $request->getResponse($response);
            }
        );

        return $promise->wait();
    }
}