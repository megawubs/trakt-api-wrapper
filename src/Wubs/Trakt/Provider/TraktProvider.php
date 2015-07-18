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

class TraktProvider extends AbstractProvider
{

    /**
     * @param integer $clientId
     * @param $clientSecret
     * @param $redirectUrl
     * @param string $state
     * @param string $type
     */
    public function __construct($clientId, $clientSecret, $redirectUrl, $state = 'state', $type = 'code')
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

    public function getAuthorizationUrl($options = [])
    {
        $this->state = isset($options['state']) ? $options['state'] : md5(uniqid(rand(), true));
        $params = [
            'response_type' => isset($options['response_type']) ? $options['response_type'] : 'code',
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'state' => $this->state
        ];

        return $this->urlAuthorize() . '?' . $this->httpBuildQuery($params, '', '&');
    }


    /**
     * Get the URL that this provider users to request an access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return 'https://trakt.tv/oauth/token';
    }

    public function urlUserDetails(AccessToken $token)
    {
    }

    public function userDetails($response, AccessToken $token)
    {
    }
}