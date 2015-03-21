<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:18
 */

namespace Wubs\Trakt\Response;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Media\Movie;

class CheckIn
{

    /**
     * @var Movie
     */
    public $movie;

    private $sharing;
    private $id;
    /**
     * @var AccessToken
     */
    private $token;

    /**
     * @param $json
     * @param $id
     * @param AccessToken $token
     */
    public function __construct($json, $id, AccessToken $token)
    {
        $this->movie = new Movie($json, $id, $token);
        $this->sharing = $json->sharing;

        $this->id = $id;
        $this->token = $token;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function isSharedOnFacebook()
    {
        return $this->isSharedOn("facebook");
    }

    public function isSharedOnTwitter()
    {
        return $this->isSharedOn("twitter");
    }

    public function isSharedOnTumblr()
    {
        return $this->isSharedOn("tumblr");
    }

    private function isSharedOn($medium)
    {
        return $this->sharing->{$medium};
    }
}