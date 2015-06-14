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

use Wubs\Trakt\Request\Users\ApproveFollowRequest as ApproveFollowRequestRequest;
use Wubs\Trakt\Request\Users\DenyFollowRequest as DenyFollowRequestRequest;
use Wubs\Trakt\Request\Users\Hidden as HiddenRequest;
use Wubs\Trakt\Request\Users\History as HistoryRequest;
use Wubs\Trakt\Request\Users\Requests as RequestsRequest;
use Wubs\Trakt\Request\Users\Settings as SettingsRequest;

class Users extends Endpoint {

    public function approveFollowRequest($followerRequestId)
    {
        return $this->request(new ApproveFollowRequestRequest($followerRequestId));
    }

	public function denyFollowRequest($followerRequestId)
    {
        return $this->request(new DenyFollowRequestRequest($followerRequestId));
    }

	public function hidden($section, $type)
    {
        return $this->request(new HiddenRequest($section, $type));
    }

	public function history($username, $type)
    {
        return $this->request(new HistoryRequest($username, $type));
    }

	public function requests(array $queryParams = [])
    {
        return $this->request(new RequestsRequest($queryParams));
    }

	public function settings(array $queryParams = [])
    {
        return $this->request(new SettingsRequest($queryParams));
    }

}

