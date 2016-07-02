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
use Wubs\Trakt\Request\Scrobble\Pause as PauseRequest;
use Wubs\Trakt\Request\Scrobble\Start as StartRequest;
use Wubs\Trakt\Request\Scrobble\Stop as StopRequest;

class Scrobble extends Endpoint {
    


    public function pause(AccessToken $token, Media $media, $progress)
    {
        return $this->request(new PauseRequest($token, $media, $progress));
    }

	public function start(AccessToken $token, Media $media, $progress)
    {
        return $this->request(new StartRequest($token, $media, $progress));
    }

	public function stop(AccessToken $token, Media $media, $progress)
    {
        return $this->request(new StopRequest($token, $media, $progress));
    }

}

