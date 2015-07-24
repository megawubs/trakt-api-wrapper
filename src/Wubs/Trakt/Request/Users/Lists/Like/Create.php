<?php


namespace Wubs\Trakt\Request\Users\Lists\Like;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Create extends AbstractRequest
{
    /**
     * @var
     */
    private $listId;
    /**
     * @var
     */
    private $username;

    /**
     * @param AccessToken $token
     * @param $username
     * @param $listId
     */
    public function __construct(AccessToken $token, $username, $listId)
    {
        parent::__construct();
        $this->setToken($token);

        $this->listId = $listId;
        $this->username = $username;
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->listId;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


    public function getUri()
    {
        return "users/:username/lists/:id/like";
    }
}