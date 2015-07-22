<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Collection extends AbstractRequest
{
    /**
     * @var
     */
    private $username;

    private $type;


    /**
     * @param AccessToken $token
     * @param $username
     * @param $type
     */
    public function __construct($username, $type, AccessToken $token = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->type = $type;
        $this->username = $username;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "users/:username/collection/:type";
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
}