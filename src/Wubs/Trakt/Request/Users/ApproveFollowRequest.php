<?php


namespace Wubs\Trakt\Request\Users;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\FollowerRequestId;
use Wubs\Trakt\Request\RequestType;

class ApproveFollowRequest extends AbstractRequest
{
    /**
     * @var FollowerRequestId
     */
    private $id;

    /**
     * @param FollowerRequestId $id
     */
    public function __construct(FollowerRequestId $id)
    {
        parent::__construct();

        $this->id = $id;
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
        return RequestType::POST;
    }


    public function getUri()
    {
        return "users/requests/:id";
    }
}