<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Shows;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Shows\Progress\Collection as CollectionRequest;
use Wubs\Trakt\Request\Shows\Progress\Watched as WatchedRequest;
use Wubs\Trakt\Api\Endpoint;

class Progress extends Endpoint {
    


    public function collection(AccessToken $token, $mediaId)
    {
        return $this->request(new CollectionRequest($token, $mediaId));
    }

	public function watched(AccessToken $token, $mediaId)
    {
        return $this->request(new WatchedRequest($token, $mediaId));
    }

}

