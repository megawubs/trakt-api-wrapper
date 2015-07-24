<?php


namespace Wubs\Trakt\Request\Users\Lists;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Delete extends AbstractRequest
{
    /**
     * @var
     */
    private $listId;
    /**
     * @var
     */
    private $username;

    public function __construct(AccessToken $token, $username, $listId)
    {
        parent::__construct();
        $this->setToken($token);

        $this->listId = $listId;
        $this->username = $username;
    }

    public function getRequestType()
    {
        return RequestType::DELETE;
    }

    /**
     * @return mixed
     */
    public function getId()
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

    public function getUri()
    {
        return 'users/:username/lists/:id';
    }
}