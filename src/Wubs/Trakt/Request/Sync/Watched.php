<?php


namespace Wubs\Trakt\Request\Sync;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Watched extends AbstractRequest
{
    /**
     * @var
     */
    private $type;

    /**
     * @param AccessToken $token
     * @param $type
     */
    public function __construct(AccessToken $token, $type)
    {
        parent::__construct();
        $this->setToken($token);
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "sync/watched/:type";
    }
}