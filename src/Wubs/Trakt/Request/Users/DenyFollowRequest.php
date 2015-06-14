<?php


namespace Wubs\Trakt\Request\Users;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\FollowerRequestId;
use Wubs\Trakt\Request\RequestType;

class DenyFollowRequest extends AbstractRequest
{
    /**
     * @var
     */
    private $id;

    /**
     * @param int $followerRequestId
     */
    public function __construct($followerRequestId)
    {
        parent::__construct();

        $this->id = $followerRequestId;
    }

    /**
     * @return FollowerRequestId
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRequestType()
    {
        return RequestType::DELETE;
    }


    public function getUri()
    {
        return "users/requests/:id";
    }
}