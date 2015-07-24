<?php


namespace Wubs\Trakt\Request\Sync\History;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Remove extends AbstractRequest
{
    /**
     * @var
     */
    private $items;

    /**
     * @param AccessToken $token
     * @param $items
     */
    public function __construct(AccessToken $token, $items)
    {
        parent::__construct();
        $this->setToken($token);

        $this->items = $items;
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUri()
    {
        return "sync/history/remove";
    }

    protected function getPostBody()
    {
        return $this->items;
    }


}