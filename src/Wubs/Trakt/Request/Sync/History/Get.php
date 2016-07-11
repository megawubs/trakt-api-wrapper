<?php


namespace Wubs\Trakt\Request\Sync\History;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Get extends AbstractRequest
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $type;

    /**
     * @param AccessToken $token
     * @param $type
     * @param $id
     */
    public function __construct(AccessToken $token, $type, $id = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->id = $id;
        $this->type = $type;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

        return (!is_null($this->id)) ? "sync/history/:type/:id" : "sync/history/:type";
    }
}