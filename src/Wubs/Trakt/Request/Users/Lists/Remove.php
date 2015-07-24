<?php


namespace Wubs\Trakt\Request\Users\Lists;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Remove extends AbstractRequest
{
    /**
     * @var
     */
    private $itemsToRemove;
    /**
     * @var
     */
    private $listId;
    /**
     * @var
     */
    private $username;

    /**
     * @param AccessToken $token
     * @param $username
     * @param $listId
     * @param $itemsToRemove
     */
    public function __construct(AccessToken $token, $username, $listId, $itemsToRemove)
    {
        parent::__construct();
        $this->setToken($token);

        $this->itemsToRemove = $itemsToRemove;
        $this->listId = $listId;
        $this->username = $username;
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUri()
    {
        return 'users/:username/lists/:id/items/remove';
    }

    protected function getPostBody()
    {
        return $this->itemsToRemove;
    }


}