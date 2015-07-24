<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Users;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Users\Followers\Approve as ApproveRequest;
use Wubs\Trakt\Request\Users\Followers\Deny as DenyRequest;
use Wubs\Trakt\Request\Users\Followers\Get as GetRequest;
use Wubs\Trakt\Api\Endpoint;

class Followers extends Endpoint {
    


    public function approve(AccessToken $token, $followerRequestId)
    {
        return $this->request(new ApproveRequest($token, $followerRequestId));
    }

	public function deny(AccessToken $token, $followerRequestId)
    {
        return $this->request(new DenyRequest($token, $followerRequestId));
    }

	public function get(AccessToken $token)
    {
        return $this->request(new GetRequest($token));
    }

}

