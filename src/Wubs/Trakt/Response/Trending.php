<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:39
 */

namespace Wubs\Trakt\Response;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Media\Movie;

class Trending
{
    public $watchers;

    /**
     * @var \Wubs\Trakt\Media\Movie
     */
    public $movie;

    /**
     * @param $json
     * @param ClientId $id
     * @param AccessToken $token
     */
    public function __construct($json, ClientId $id, AccessToken $token)
    {
        $this->watchers = $json->watchers;
        $this->movie = new Movie($json->movie, $id, $token);
    }
}