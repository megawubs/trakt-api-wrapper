<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class CustomList extends AbstractRequest
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
     * @param $username
     * @param $listId
     * @param AccessToken|null $token
     */
    public function __construct($username, $listId, AccessToken $token = null)
    {
        parent::__construct();
        $this->setToken($token);

        $this->listId = $listId;
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getListId()
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


    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return 'users/:username/lists/:id';
    }
}