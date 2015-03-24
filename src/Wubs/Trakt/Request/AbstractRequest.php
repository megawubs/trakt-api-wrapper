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
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Exception\HttpCodeException\ExceptionStatusCodeFactory;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;
use Wubs\Trakt\Response\Handlers\DefaultResponseHandler;
use Wubs\Trakt\Response\Handlers\DefaultDeleteHandler;

abstract class AbstractRequest
{
    /**
     * @var ClientId
     */
    private $clientId;

    private $page = 1;

    private $limit = 10;

    private $scheme = 'https';

    private $host = 'api-v2launch.trakt.tv';

    protected $staging = "https://api.staging.trakt.tv";

    protected $queryParams = [];

    protected $allowedExtended;

    /**
     * @var ResponseHandler
     */
    private $responseHandler;

    private $apiVersion = 2;

    private $extended;

    private $environment = 'prod';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var AccessToken
     */
    private $token;

    /**
     * @param string $extended
     * @param int $page
     * @param int $limit
     * @param int $apiVersion
     * @param array $queryParams
     */
    public function __construct($extended = 'min', $page = 1, $limit = 10, $apiVersion = 2, array $queryParams = [])
    {
        $this->extended = $extended;
        $this->client = $this->getClient($apiVersion);
        $this->apiVersion = $apiVersion;
        $this->page = $page;
        $this->limit = $limit;
        $this->queryParams = $queryParams;

        $this->setResponseHandler(new DefaultResponseHandler());
    }

    /**
     * @param $clientId
     */
    public function setClientId(ClientId $clientId)
    {
        if (!is_null($clientId)) {
            $this->clientId = $clientId;
        }
    }

    /**
     * @param AccessToken $token
     */
    public function setToken(AccessToken $token)
    {
        $this->token = $token;
    }

    /**
     * @param $level
     */
    public function setExtended($level)
    {
        $this->extended = $level;
    }

    /**
     * @param array $params
     */
    public function setQueryParams(array $params)
    {
        $this->queryParams = $params;
    }

    public function setEnvironment($environment)
    {
        $allowed = ['prod', 'staging'];
        if (in_array($environment, $allowed)) {
            $this->environment = $environment;
            $this->client = $this->getClient();
        }
    }

    /**
     * @param ClientId $clientId
     * @param AccessToken $token
     * @param array $parameters
     * @param AbstractResponseHandler $responseHandler
     * @return mixed
     */
    public static function request(
        ClientId $clientId,
        AccessToken $token,
        array $parameters = [],
        AbstractResponseHandler $responseHandler = null
    ) {
        $reflection = new \ReflectionClass(static::class);
        $request = $reflection->newInstanceArgs($parameters);

        $request->setToken($token);

        if ($responseHandler) {
            $request->setResponseHandler($responseHandler);
        }

        return $request->call($clientId);
    }

    public function call(ClientId $clientId = null)
    {
        $this->setClientId($clientId);
        $request = $this->client->createRequest(
            $this->getRequestType(),
            $this->getUrl(),
            $this->getOptions()
        );

        $response = $this->client->send($request);

        if ($this->requestNotSuccessful($response)) {
            throw ExceptionStatusCodeFactory::create($response->getStatusCode());
        }

        return $this->handleResponse($response);
    }

    public function getUrl()
    {
        return UriBuilder::format($this);
    }

    /**
     * @param ResponseHandler $responseHandler
     */
    public function setResponseHandler(ResponseHandler $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }


    protected function handleResponse(ResponseInterface $response)
    {
        $handler = $this->getResponseHandler();

        $handler->setId($this->clientId);
        $handler->setToken($this->token);

        return $handler->handle($response);
    }

    /**
     * @return ResponseHandler
     */
    public function getResponseHandler()
    {
        return $this->responseHandler;
    }

    protected function getPostBody()
    {
        return [];
    }

    /**
     * @return array
     */
    private function getOptions()
    {
        $options = [
            "headers" => $this->getHeaders(),
            "query" => $this->queryParams
        ];

        return $this->setBody($options);
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

    /**
     *
     * @return Client
     */
    private function getClient()
    {
        $host = $this->host;

        if ($this->environment === 'staging') {
            $host = $this->staging;
        }
        return new Client(['base_url' => [$this->scheme . '://' . $host, ['version' => $this->apiVersion]]]);
    }

    /**
     * @param $options
     * @return mixed
     */
    private function setBody($options)
    {
        if ($this->needsPostBody()) {
            $options['body'] = json_encode($this->getPostBody());
            return $options;
        }

        return $options;
    }

    private function needsPostBody()
    {
        return in_array($this->getRequestType(), [RequestType::PUT, RequestType::POST]);
    }

    abstract public function getRequestType();

    abstract public function getUri();
}