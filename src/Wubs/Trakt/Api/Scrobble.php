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
use Wubs\Trakt\Request\Scrobble\Pause as PauseRequest;
use Wubs\Trakt\Request\Scrobble\Start as StartRequest;
use Wubs\Trakt\Request\Scrobble\Stop as StopRequest;

class Scrobble extends Endpoint {

    

    public function pause(Media $media)
    {
        return $this->request(new PauseRequest($media));
    }

	public function start(Media $media)
    {
        return $this->request(new StartRequest($media));
    }

	public function stop(Media $media)
    {
        return $this->request(new StopRequest($media));
    }

}

