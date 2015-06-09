<?php namespace Wubs\Trakt;


use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Url;
use Guzzle\Service\Client;
use League\OAuth2\Client\Provider\ProviderInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Contracts\RequestInterface;
use Wubs\Trakt\Exception\InvalidOauthRequestException;
use Wubs\Trakt\Provider\TraktProvider;
use Wubs\Trakt\Request\AbstractRequest;

class Trakt
{

    /**
     * @param $clientId
     * @return Api
     */
    public static function api($clientId)
    {
        return new Api(ClientId::set($clientId));
    }

    /**
     * @param $clientId
     * @param $clientSecret
     * @param $redirectUrl
     * @return Auth
     */
    public static function auth($clientId, $clientSecret, $redirectUrl)
    {
        return new Auth(ClientId::set($clientId), $clientSecret, $redirectUrl);
    }
}