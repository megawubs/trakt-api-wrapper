<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 11:08
 */

namespace Wubs\Trakt\Request;


use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Request\Exception\HttpCodeException\ExceptionStatusCodeFactory;
use Wubs\Trakt\Token\TraktToken;

abstract class  AbstractRequest
{
    private $clientId;

    private $page = 1;

    private $limit = 10;

    private $scheme = 'https';

    private $host = 'api-v2launch.trakt.tv';

    private $apiVersion = 2;

    protected $queryParams = [];
    /**
     * @var TraktToken
     */
    private $token;

    public function __construct($extended = 'min', $page = 1, $limit = 10, $apiVersion = 2, array $queryParams = [])
    {
        $this->client = new Client(['base_url' => [$this->scheme . '://' . $this->host, ['version' => $apiVersion]]]);
        $this->apiVersion = $apiVersion;
        $this->page = $page;
        $this->limit = $limit;
        $this->queryParams = $queryParams;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function setToken(TraktToken $token)
    {
        $this->token = $token;
    }


    public function call()
    {
        $request = $this->client->createRequest($this->getMethod(), $this->getUrl(), $this->getOptions());
        $response = $this->client->send($request);

        if ($this->requestNotSuccessful($response)) {
            throw ExceptionStatusCodeFactory::create($response->getStatusCode());
        }

        return $this->handleResponse($response);
    }

    /**
     * @return array
     */
    private function getOptions()
    {
        return [
            "headers" => $this->getHeaders(),
            "query" => $this->queryParams
        ];
    }

    /**
     * @return array
     */
    private function getHeaders()
    {
        return [
            "content-type" => "application/json",
            'Authorization' => "Bearer " . $this->token->accessToken,
            "trakt-api-version" => 2,
            "trakt-api-key" => $this->clientId
        ];
    }

    private function requestNotSuccessful(ResponseInterface $response)
    {
        return (!in_array($response->getStatusCode(), [200, 201, 204]));
    }

    abstract protected function handleResponse(ResponseInterface $response);

    abstract public function getMethod();

    abstract public function getUrl();
}