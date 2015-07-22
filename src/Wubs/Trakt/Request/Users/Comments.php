<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Comments extends AbstractRequest
{
    /**
     * @var
     */
    private $commentType;
    /**
     * @var
     */
    private $username;

    private $type;

    /**
     * @param $username
     * @param $commentType
     * @param $type
     * @param AccessToken $token
     */
    public function __construct($username, $commentType, $type, AccessToken $token)
    {
        parent::__construct();
        $this->setToken($token);
        $this->type = $type;
        $this->commentType = $commentType;
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getCommentType()
    {
        return $this->commentType;
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


    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "users/:username/comments/:commentType/:type";
    }
}