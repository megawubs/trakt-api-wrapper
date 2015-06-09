<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 11:08
 */

namespace Wubs\Trakt\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Message\ResponseInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Exception\HttpCodeException\ExceptionStatusCodeFactory;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;
use Wubs\Trakt\Response\Handlers\DefaultResponseHandler;

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
     * @var AccessToken|null
     */
    private $token = null;

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
    public function setToken(AccessToken $token = null)
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
     * @param ResponseHandler|AbstractResponseHandler $responseHandler
     * @return mixed
     * @throws Exception\HttpCodeException\RateLimitExceededException
     * @throws Exception\HttpCodeException\ServerErrorException
     * @throws Exception\HttpCodeException\ServerUnavailableException
     * @throws Exception\HttpCodeException\StatusCodeException
     */
    public static function request(
        ClientId $clientId,
        $token = null,
        $parameters = [],
        ResponseHandler $responseHandler = null
    ) {
        /*
         * Check if the user passed the token as second parameter, if not
         * and it is an array (meaning it are the parameters) reassign the variables.
         */
        if (is_array($token)) {
            list($parameters, $responseHandler, $token,) = [$token, $parameters, null];
        }

        if ($token instanceof ResponseHandler) {
            list($parameters, $token, $responseHandler) = [[], null, $token];
        }

        $reflection = new \ReflectionClass(static::class);
        /** @var AbstractRequest $request */
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
        try {
            $response = $this->client->send($request);
        } catch (ServerException $exception) {
            $response = $exception->getResponse();
        }


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
        $token = (is_null($this->token)) ? "" : "Bearer " . $this->token;
        return [
            "content-type" => "application/json",
            'Authorization' => $token,
            "trakt-api-version" => 2,
            "trakt-api-key" => $this->clientId
        ];
    }

    private function requestNotSuccessful(ResponseInterface $response)
    {
        return (!in_array($response->getStatusCode(), [200, 201, 204, 504]));
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