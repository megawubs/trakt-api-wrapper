<?php

namespace Wubs\Trakt\Auth;

use Wubs\Trakt\Exception\InvalidOauthRequestException;
use Wubs\Trakt\Auth\TraktProvider;

class Auth
{
    /**
     * @var \Wubs\Trakt\Auth\TraktProvider
     */
    public $provider;

    /**
     * @param TraktProvider $provider
     */
    public function __construct(TraktProvider $provider)
    {
        $this->provider = $provider;
    }

    public function authorize()
    {
        $_SESSION['trakt_oauth_state'] = $this->provider->state;
        return $this->provider->authorize();
    }

    public function token($code)
    {
        try {
            return $this->provider->getAccessToken("authorization_code", ["code" => $code]);
        } catch (\Exception $exception) {
            throw new InvalidOauthRequestException;
        }
    }

    public function isValid()
    {
        return (empty($_GET['state']) || ($_GET['state'] === $_SESSION['trakt_oauth_state']));
    }

    public function invalid()
    {
        unset($_SESSION['trakt_oauth_state']);
    }

    public function refresh($refreshToken)
    {
        return $this->provider->getAccessToken("refresh_token", ['refresh_token' => $refreshToken, 'code' => $refreshToken]);
    }

    public function createToken($token, $type, $expires, $refresh, $scope)
    {
        return Token::create($token, $type, $expires, $refresh, $scope);
    }
}
