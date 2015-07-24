<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Users\Lists;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Users\Lists\Like\Create as CreateRequest;
use Wubs\Trakt\Request\Users\Lists\Like\Delete as DeleteRequest;
use Wubs\Trakt\Api\Endpoint;

class Like extends Endpoint {
    


    public function create(AccessToken $token, $username, $listId)
    {
        return $this->request(new CreateRequest($token, $username, $listId));
    }

	public function delete(AccessToken $token, $username, $listId)
    {
        return $this->request(new DeleteRequest($token, $username, $listId));
    }

}

