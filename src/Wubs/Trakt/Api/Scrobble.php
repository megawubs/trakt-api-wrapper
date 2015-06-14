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

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\Scrobble\Pause as RequestPause;
use Wubs\Trakt\Request\Scrobble\Start as RequestStart;
use Wubs\Trakt\Request\Scrobble\Stop as RequestStop;

class Scrobble extends Endpoint {

    public function pause(Media $media)
    {
        return $this->request(new RequestPause($media));
    }

	public function start(Media $media)
    {
        return $this->request(new RequestStart($media));
    }

	public function stop(Media $media)
    {
        return $this->request(new RequestStop($media));
    }

}

