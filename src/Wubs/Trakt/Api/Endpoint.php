<?php


namespace Wubs\Trakt\Api;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\AbstractRequest;

abstract class Endpoint
{

    private $clientId;

    /**
     * @param ClientId $clientId
     */
    public function __construct(ClientId $clientId)
    {
        $this->clientId = $clientId;
    }

    protected function request(AbstractRequest $request, AccessToken $token = null)
    {
        return $request->make($this->clientId, $token);
    }
}