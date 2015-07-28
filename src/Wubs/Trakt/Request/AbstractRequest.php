<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 11:08
 */

namespace Wubs\Trakt\Request;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Exception\HttpCodeException\ExceptionStatusCodeFactory;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;
use Wubs\Trakt\Response\Handlers\DefaultResponseHandler;

abstract class AbstractRequest
{
    /**
     * @var string
     */
    private $clientId;

    private $page = 1;

    private $limit = 10;

    /**
     * @var Collection|string[]
     */
    protected $queryParams;

    protected $allowedExtended;

    /**
     * @var ResponseHandler
     */
    private $responseHandler;

    /**
     * @var AccessToken|null
     */
    private $token = null;

    private $extended;

    /**
     *
     */
    public function __construct()
    {
        $this->queryParams = new Collection();

        $this->setResponseHandler(new DefaultResponseHandler());
    }

    /**
     * @param $clientId
     */
    public function setClientId($clientId)
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
     * @return $this
     */
    public function setExtended($level)
    {
        $this->addQueryParam("extended", $level);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtended()
    {
        return $this->extended;
    }


    /**
     * @param int $page
     * @return AbstractRequest
     */
    public function setPage($page)
    {
        $this->addQueryParam('page', $page);
        return $this;
    }

    /**
     * @param int $limit
     * @return AbstractRequest
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function addQueryParam($key, $value)
    {
        $this->queryParams->put($key, $value);
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setQueryParams($params)
    {
        if (is_array($params)) {
            $this->queryParams = collect($params);
            return $this;
        }

        if ($params instanceof Collection) {
            $this->queryParams = $params;
            return $this;
        }

        throw new \InvalidArgumentException("The parameters should be an array or an instance of " . Collection::class);
    }

    /**
     * @param $clientId
     * @param ClientInterface $client
     * @param ResponseHandler|AbstractResponseHandler $responseHandler
     * @return mixed
     * @throws Exception\HttpCodeException\RateLimitExceededException
     * @throws Exception\HttpCodeException\ServerErrorException
     * @throws Exception\HttpCodeException\ServerUnavailableException
     * @throws Exception\HttpCodeException\StatusCodeException
     */
    public function make($clientId, ClientInterface $client, ResponseHandler $responseHandler = null)
    {
        $this->setResponseHandler($responseHandler);

        $this->setClientId($clientId);

        $request = $this->createRequest($client);

        $response = $this->send($client, $request);

        if ($this->notSuccessful($response)) {
            throw ExceptionStatusCodeFactory::create($response->getStatusCode());
        }

        return $this->handleResponse($response, $client);
    }

    public function getUrl()
    {
        return UriBuilder::format($this);
    }

    /**
     * @param ResponseHandler $responseHandler
     */
    public function setResponseHandler(ResponseHandler $responseHandler = null)
    {
        if ($responseHandler) {
            $this->responseHandler = $responseHandler;
        }
    }


    protected function handleResponse(ResponseInterface $response, ClientInterface $client)
    {
        $handler = $this->getResponseHandler();

        $handler->setClientId($this->clientId);
        $handler->setToken($this->token);

        return $handler->handle($response, $client);
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
            "query" => $this->queryParams->toArray()
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

    private function notSuccessful(ResponseInterface $response)
    {
        return (!in_array($response->getStatusCode(), [200, 201, 204, 504]));
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

    /**
     * @param ClientInterface $client
     * @param $request
     * @return ResponseInterface|null
     */
    private function send(ClientInterface $client, $request)
    {
        try {
            $response = $client->send($request);
            return $response;
        } catch (ServerException $exception) {
            $response = $exception->getResponse();
            return $response;
        }
    }

    /**
     * @param ClientInterface $client
     * @return \GuzzleHttp\Message\RequestInterface
     */
    private function createRequest(ClientInterface $client)
    {
        $request = $client->createRequest(
            $this->getRequestType(),
            $this->getUrl(),
            $this->getOptions()
        );
        return $request;
    }

    abstract public function getRequestType();

    abstract public function getUri();
}