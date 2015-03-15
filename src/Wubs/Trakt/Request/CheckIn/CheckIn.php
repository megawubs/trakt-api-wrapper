<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:33
 */

namespace Wubs\Trakt\Request\CheckIn;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Media\Movie;

class CheckIn
{

    public static function movie(ClientId $id, AccessToken $token, Movie $movie)
    {
        return MovieCheckIn::request($id, $token, $movie);
    }

}