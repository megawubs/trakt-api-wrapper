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

use Wubs\Trakt\Request\Recommendations\DismissMovie as DismissMovieRequest;
use Wubs\Trakt\Request\Recommendations\DismissShow as DismissShowRequest;
use Wubs\Trakt\Request\Recommendations\Movies as MoviesRequest;
use Wubs\Trakt\Request\Recommendations\Shows as ShowsRequest;

class Recommendations extends Endpoint {

    

    public function dismissMovie($mediaId)
    {
        return $this->request(new DismissMovieRequest($mediaId));
    }

	public function dismissShow($mediaId)
    {
        return $this->request(new DismissShowRequest($mediaId));
    }

	public function movies()
    {
        return $this->request(new MoviesRequest());
    }

	public function shows()
    {
        return $this->request(new ShowsRequest());
    }

}

