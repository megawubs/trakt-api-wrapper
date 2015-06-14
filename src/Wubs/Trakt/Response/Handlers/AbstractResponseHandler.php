<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:42
 */

namespace Wubs\Trakt\Response\Handlers;


use GuzzleHttp\Message\ResponseInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;

class AbstractResponseHandler
{

    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var AccessToken
     */
    private $token;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    protected function transformToObjects(ResponseInterface $response, $objectName)
    {
        $objects = [];
        foreach ($this->getJson($response) as $item) {
            $objects[] = $this->transformToObject($item, $objectName);
        }

        return $objects;
    }

    protected function transformToObject($item, $objectName)
    {
        return new $objectName($item, $this->getId(), $this->getToken());
    }


}