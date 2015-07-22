<?php


namespace Wubs\Trakt\Request\Users\Lists;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Get extends AbstractRequest
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var null
     */
    private $listId;

    /**
     * @param string $username
     * @param null $listId
     * @param AccessToken|null $token
     */
    public function __construct($username, $listId = null, AccessToken $token = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->username = $username;
        $this->listId = $listId;
    }

    /**
     * @return array
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null
     */
    public function getListId()
    {
        return $this->listId;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return ($this->listId === null) ? 'users/:username/lists' : 'users/:username/lists/:listId';
    }
}