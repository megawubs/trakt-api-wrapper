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
use Wubs\Trakt\Request\Users\Follow\Approve as ApproveRequest;
use Wubs\Trakt\Request\Users\Follow\Deny as DenyRequest;
use Wubs\Trakt\Api\Endpoint;

class Follow extends Endpoint {
    


    public function approve(AccessToken $token, $followerRequestId)
    {
        return $this->request(new ApproveRequest($token, $followerRequestId));
    }

	public function deny(AccessToken $token, $followerRequestId)
    {
        return $this->request(new DenyRequest($token, $followerRequestId));
    }

}

