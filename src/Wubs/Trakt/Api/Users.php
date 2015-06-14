<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api;

use Wubs\Trakt\Request\Users\ApproveFollowRequest as RequestApproveFollowRequest;
use Wubs\Trakt\Request\Users\DenyFollowRequest as RequestDenyFollowRequest;
use Wubs\Trakt\Request\Users\Hidden as RequestHidden;
use Wubs\Trakt\Request\Users\History as RequestHistory;
use Wubs\Trakt\Request\Users\Requests as RequestRequests;
use Wubs\Trakt\Request\Users\Settings as RequestSettings;

class Users extends Endpoint {

    public function approveFollowRequest( $followerRequestId)
    {
        return $this->request(new RequestApproveFollowRequest($followerRequestId));
    }

	public function denyFollowRequest( $followerRequestId)
    {
        return $this->request(new RequestDenyFollowRequest($followerRequestId));
    }

	public function hidden( $section,  $type)
    {
        return $this->request(new RequestHidden($section, $type));
    }

	public function history( $username,  $type)
    {
        return $this->request(new RequestHistory($username, $type));
    }

	public function requests( $queryParams)
    {
        return $this->request(new RequestRequests($queryParams));
    }

	public function settings( $queryParams)
    {
        return $this->request(new RequestSettings($queryParams));
    }

}

