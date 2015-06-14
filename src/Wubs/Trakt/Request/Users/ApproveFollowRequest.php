<?php


namespace Wubs\Trakt\Request\Users;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class ApproveFollowRequest extends AbstractRequest
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
     * @return int
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