<?php


namespace Wubs\Trakt;


use Wubs\Trakt\Exception\InvalidOauthRequestException;
use Wubs\Trakt\Provider\TraktProvider;

class Auth
{
    /**
     * @var ClientId
     */
    private $clientId;
    private $clientSecret;
    private $redirectUrl;

    /**
     * @param ClientId $clientId
     * @param $clientSecret
     * @param $redirectUrl
     */
    public function __construct(ClientId $clientId, $clientSecret, $redirectUrl)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;

        $this->provider = $this->getProvider();
    }

    public function authorize()
    {
        $_SESSION['trakt_oauth_state'] = $this->provider->state;
        return $this->provider->authorize();
    }

    public function getToken($code)
    {
        try {
            $params = ["code" => $code];
            return $this->provider->getAccessToken("authorization_code", $params);
        } catch (\Exception $exception) {
            throw new InvalidOauthRequestException;
        }
    }

    /**
     * @return TraktProvider
     */
    private function getProvider()
    {
        return new TraktProvider($this->clientId, $this->clientSecret, $this->redirectUrl);
    }

    public function isValid()
    {
        return (empty($_GET['state']) || ($_GET['state'] === $_SESSION['trakt_oauth_state']));
    }

    public function invalid()
    {
        unset($_SESSION['trakt_oauth_state']);
    }

    public function refreshAccessToken($refreshToken)
    {
        $params = ['refresh_token' => $refreshToken, 'code' => $refreshToken];
        return $this->provider->getAccessToken("refresh_token", $params);
    }
}