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

use Wubs\Trakt\Request\Recommendations\DismissMovie as RequestDismissMovie;
use Wubs\Trakt\Request\Recommendations\DismissShow as RequestDismissShow;
use Wubs\Trakt\Request\Recommendations\Movies as RequestMovies;
use Wubs\Trakt\Request\Recommendations\Shows as RequestShows;

class Recommendations extends Endpoint {

    public function dismissMovie( $mediaId)
    {
        return $this->request(new RequestDismissMovie($mediaId));
    }

	public function dismissShow( $mediaId)
    {
        return $this->request(new RequestDismissShow($mediaId));
    }

	public function movies( $queryParams)
    {
        return $this->request(new RequestMovies($queryParams));
    }

	public function shows( $queryParams)
    {
        return $this->request(new RequestShows($queryParams));
    }

}

