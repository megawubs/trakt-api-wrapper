<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Lists extends AbstractRequest
{
    /**
     * @var string
     */
    private $username;

    /**
     * @param string $username
     * @param AccessToken|null $token
     */
    public function __construct($username, AccessToken $token = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->username = $username;
    }

    /**
     * @return array
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "users/:username/lists";
    }
}