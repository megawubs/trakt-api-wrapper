<?php namespace Wubs\Trakt;


use Guzzle\Http\Url;
use Guzzle\Service\Client;
use League\OAuth2\Client\Provider\ProviderInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Contracts\RequestInterface;

class Trakt
{
    /**
     * @var TraktToken
     */
    private $token;
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param TraktToken $token
     * @param RequestInterface $request
     */
    public function __construct(TraktToken $token, RequestInterface $request)
    {
        $this->token = $token;
        $this->request = $request;
    }

    public function get($path, $options = [])
    {
        return $this->makeRequest($path, $options, "GET");
    }

    public function post($path, $options = [])
    {
        return $this->makeRequest($path, $options, "POST");
    }

    public function settings()
    {
        return $this->get("users/settings");
    }

    /**
     * @param $path
     * @param array $options
     * @param $method
     * @return array
     */
    private function makeRequest($path, $options = [], $method)
    {
        $this->request->create($method, $path, $this->token, $options);
        return $this->request->send();
    }
}