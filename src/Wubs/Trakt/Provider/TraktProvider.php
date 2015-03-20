<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 20/02/15
 * Time: 22:12
 */

namespace Wubs\Trakt\Provider;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Token\TraktAccessToken;

class TraktProvider extends AbstractProvider
{
    public $responseType;
    private $username;
    /**
     * @var string
     */

    /**
     * @param ClientId $clientId
     * @param $clientSecret
     * @param $redirectUrl
     * @param string $state
     * @param string $type
     */
    public function __construct(ClientId $clientId, $clientSecret, $redirectUrl, $state = 'state', $type = 'code')
    {
        parent::__construct(
            [
                "clientId" => (string)$clientId,
                "clientSecret" => $clientSecret,
                "redirectUri" => $redirectUrl,
                "state" => $state,
                "response_type" => $type
            ]
        );
    }

    /**
     * Get the URL that this provider uses to begin authorization.
     *
     * @return string
     */
    public function urlAuthorize()
    {
        return 'https://trakt.tv/oauth/authorize';
    }

    /**
     * Get the URL that this provider users to request an access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return 'https://api-v2launch.trakt.tv/oauth/token';
    }

    public function urlUserDetails(AccessToken $token)
    {
    }

    public function userDetails($response, AccessToken $token)
    {
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
}