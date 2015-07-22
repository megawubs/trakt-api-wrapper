<?php


namespace Wubs\Trakt\Request\Users\Lists;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Update extends AbstractRequest
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $username;
    /**
     * @var array
     */
    private $updates;

    /**
     * @param AccessToken $token
     * @param $username
     * @param $id
     * @param array $updates
     */
    public function __construct(AccessToken $token, $username, $id, $updates)
    {
        parent::__construct();
        $this->setToken($token);
        $this->id = $id;
        $this->username = $username;
        $this->updates = $updates;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    public function getRequestType()
    {
        return RequestType::PUT;
    }

    public function getUri()
    {
        return 'users/:username/lists/:id';
    }

    protected function getPostBody()
    {
        return $this->updates;
    }


}