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

use Wubs\Trakt\Request\People\Movies as RequestMovies;
use Wubs\Trakt\Request\People\Shows as RequestShows;
use Wubs\Trakt\Request\People\Summary as RequestSummary;

class People extends Endpoint {

    public function movies( $mediaId)
    {
        return $this->request(new RequestMovies($mediaId));
    }

	public function shows( $mediaId)
    {
        return $this->request(new RequestShows($mediaId));
    }

	public function summary( $mediaId)
    {
        return $this->request(new RequestSummary($mediaId));
    }

	public function get( $mediaId)
    {
        return $this->request(new RequestSummary($mediaId));
    }

}

