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
use Wubs\Trakt\Request\Users\Lists\Create as CreateRequest;
use Wubs\Trakt\Request\Users\Lists\Delete as DeleteRequest;
use Wubs\Trakt\Request\Users\Lists\Get as GetRequest;
use Wubs\Trakt\Request\Users\Lists\Remove as RemoveRequest;
use Wubs\Trakt\Request\Users\Lists\Update as UpdateRequest;
use Wubs\Trakt\Api\Endpoint;

class Lists extends Endpoint {
    
    /**
     * @var \Wubs\Trakt\Api\Users\Lists\Like
    */
    public $like;

    public function create(AccessToken $token, $username, $list)
    {
        return $this->request(new CreateRequest($token, $username, $list));
    }

	public function delete(AccessToken $token, $username, $listId)
    {
        return $this->request(new DeleteRequest($token, $username, $listId));
    }

	public function get($username, $listId = null, AccessToken $token = null)
    {
        return $this->request(new GetRequest($username, $listId, $token));
    }

	public function remove(AccessToken $token, $username, $listId, $itemsToRemove)
    {
        return $this->request(new RemoveRequest($token, $username, $listId, $itemsToRemove));
    }

	public function update(AccessToken $token, $username, $id, $updates)
    {
        return $this->request(new UpdateRequest($token, $username, $id, $updates));
    }

}

