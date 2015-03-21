<?php namespace Wubs\Trakt;


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
    private $clientId;
    private $clientSecret;
    private $redirectUrl;

    /**
     *
     * @param $clientId
     * @param $clientSecret
     * @param $redirectUrl
     */
    public function __construct($clientId, $clientSecret, $redirectUrl)
    {
        $this->clientId = ClientId::set($clientId);
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;

        $this->provider = $this->getProvider();
    }

    public function authorize()
    {
        $_SESSION['trakt_oauth_state'] = $this->provider->state;
        return $this->provider->authorize();
    }

    public function getAccessToken($code)
    {
        $params = ["code" => $code];
        return $this->provider->getAccessToken("authorization_code", $params);
    }

    /**
     * @param AbstractRequest $request
     */
    public function call(AbstractRequest $request)
    {
        return $request->call($this->clientId);
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
}