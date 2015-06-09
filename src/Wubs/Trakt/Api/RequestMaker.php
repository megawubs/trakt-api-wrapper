<?php


namespace Wubs\Trakt\Api;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\AbstractRequest;

trait RequestMaker
{
    /**
     * @var ClientId
     */
    protected $clientId;

    protected function request(AbstractRequest $request, AccessToken $token = null)
    {
        return $request->make($this->clientId, $token);
    }
}