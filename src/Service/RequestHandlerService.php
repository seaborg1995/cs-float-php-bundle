<?php

namespace CsFloatPhpBundle\Service;

use CsFloatPhpBundle\Request\AbstractRequest;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class RequestHandlerService
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function handleApiRequest(AbstractRequest $request)
    {
        $response = $this->client->request(
            $request->getMethod(),
            $request->getUrl(),
            array_merge($request->getBody())
        );

        return $request->getResponse($response);
    }
}