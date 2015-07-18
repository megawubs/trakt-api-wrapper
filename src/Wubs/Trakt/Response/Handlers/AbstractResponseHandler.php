<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:42
 */

namespace Wubs\Trakt\Response\Handlers;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use League\OAuth2\Client\Token\AccessToken;

class AbstractResponseHandler
{

    private $clientId;

    /**
     * @var AccessToken
     */
    private $token;

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return AccessToken
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param AccessToken $token
     */
    public function setToken(AccessToken $token = null)
    {
        if ($token instanceof AccessToken || $token === null) {
            $this->token = $token;
        }
    }

    protected function getJson(ResponseInterface $response)
    {
        return $response->json(["object" => true]);
    }

    protected function transformToObjects(ResponseInterface $response, $objectName, ClientInterface $client)
    {
        $objects = [];
        foreach ($this->getJson($response) as $item) {
            $objects[] = $this->transformToObject($item, $objectName, $client);
        }

        return $objects;
    }

    protected function transformToObject($item, $objectName, ClientInterface $client)
    {
        return new $objectName($item, $this->getClientId(), $this->getToken(), $client);
    }


}