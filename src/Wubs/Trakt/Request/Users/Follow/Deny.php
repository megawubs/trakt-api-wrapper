<?php


namespace Wubs\Trakt\Request\Users\Follow;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\FollowerRequestId;
use Wubs\Trakt\Request\RequestType;

class Deny extends AbstractRequest
{
    /**
     * @var
     */
    private $id;

    /**
     * @param AccessToken $token
     * @param int $followerRequestId
     */
    public function __construct(AccessToken $token, $followerRequestId)
    {
        parent::__construct();
        $this->setToken($token);
        $this->id = $followerRequestId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRequestType()
    {
        return RequestType::DELETE;
    }


    public function getUri()
    {
        return "users/requests/:id";
    }
}