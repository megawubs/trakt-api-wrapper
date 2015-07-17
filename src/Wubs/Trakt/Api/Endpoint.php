<?php


namespace Wubs\Trakt\Api;


use GuzzleHttp\ClientInterface;
use Wubs\Trakt\Request\AbstractRequest;

abstract class Endpoint
{

    private $clientId;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param string $clientId
     * @param ClientInterface $client
     */
    public function __construct($clientId, ClientInterface $client)
    {
        $this->clientId = $clientId;
        $this->client = $client;
    }

    protected function request(AbstractRequest $request)
    {
        return $request->make($this->clientId, $this->client);
    }
}