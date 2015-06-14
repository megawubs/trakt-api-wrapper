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
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\CheckIn\Create as CreateRequest;
use Wubs\Trakt\Request\CheckIn\Delete as DeleteRequest;

class CheckIn extends Endpoint {

    public function create(AccessToken $token, Movie $movie,  $sharing)
    {
        return $this->request(new CreateRequest($token, $movie, $sharing));
    }

	public function delete(AccessToken $token)
    {
        return $this->request(new DeleteRequest($token));
    }

}

