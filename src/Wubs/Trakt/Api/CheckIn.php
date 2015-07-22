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

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\CheckIn\Create as CreateRequest;
use Wubs\Trakt\Request\CheckIn\Delete as DeleteRequest;

class CheckIn extends Endpoint {

    

    public function create(AccessToken $token, Media $media, $message = null, array $sharing = [], $venueId = null, $venueName = null, $appVersion = null, $appDate = null)
    {
        return $this->request(new CreateRequest($token, $media, $message, $sharing, $venueId, $venueName, $appVersion, $appDate));
    }

	public function delete(AccessToken $token)
    {
        return $this->request(new DeleteRequest($token));
    }

}

