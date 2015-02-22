<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 15:51
 */

namespace Wubs\Trakt;


use Guzzle\Http\Url;
use GuzzleHttp\Client;
use Wubs\Trakt\Contracts\RequestInterface as RequestInterface;

class Request implements RequestInterface
{
    private $path;
    /**
     * @var TraktToken
     */
    private $token;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $base = "api-v2launch.trakt.tv/";

    /**
     * @var string
     */
    private $scheme = "https";

    /**
     * @var array
     */
    private $options;

    /**
     * @var \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    private $request;

    /**
     * @var String
     */
    private $method;


    /**
     * @param $method
     * @param TraktToken $path
     * @param TraktToken $token
     * @param array $options
     * @return Request
     */
    public function create($method, $path, TraktToken $token, $options = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->token = $token;
        $this->options = $options;

        $this->client = new Client();
        $this->buildRequest();

        return $this;
    }

    /**
     * @return array
     */
    public function send()
    {
        return $this->client->send($this->request)->json();
    }

    /**
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Request
     */
    private function buildRequest()
    {
        $this->request = $this->client->createRequest(
            $this->method,
            $this->buildUrl(),
            $this->getRequestOptions()
        );

        return $this;
    }


    /**
     * @return Url
     */
    private function buildUrl()
    {

        $url = (new Url($this->scheme, $this->base))->setPath($this->path);

        foreach ($this->options as $option) {
            $url->addPath($option);
        }

        return $url;
    }

    /**
     * @return array
     */
    private function getRequestOptions()
    {
        return [
            "headers" => [
                "content-type" => "application/json",
                'Authorization' => "Bearer " . $this->token->accessToken,
                "trakt-api-version" => 2,
                "trakt-api-key" => getenv("CLIENT_ID")
            ]
        ];
    }
}