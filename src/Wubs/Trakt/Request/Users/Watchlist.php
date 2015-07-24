<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Watchlist extends AbstractRequest
{
    /**
     * @var null
     */
    private $type;
    /**
     * @var
     */
    private $username;

    /**
     * @param $username
     * @param null $type
     * @param AccessToken|null $token
     */
    public function __construct($username, $type = null, AccessToken $token = null)
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

        return (!is_null($this->type))
            ? "users/:username/watchlist/:type"
            : "users/:username/watchlist";
    }
}