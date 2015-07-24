<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Sync;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Sync\Watchlist\Add as AddRequest;
use Wubs\Trakt\Request\Sync\Watchlist\Get as GetRequest;
use Wubs\Trakt\Request\Sync\Watchlist\Remove as RemoveRequest;
use Wubs\Trakt\Api\Endpoint;

class Watchlist extends Endpoint {
    


    public function add(AccessToken $token, $items)
    {
        return $this->request(new AddRequest($token, $items));
    }

	public function get(AccessToken $token, $type = null)
    {
        return $this->request(new GetRequest($token, $type));
    }

	public function remove(AccessToken $token, $items)
    {
        return $this->request(new RemoveRequest($token, $items));
    }

}

