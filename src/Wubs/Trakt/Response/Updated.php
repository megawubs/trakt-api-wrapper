<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:49
 */

namespace Wubs\Trakt\Response;


use Carbon\Carbon;
use DateTime;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Media\Movie;

class Updated
{

    /**
     * @var Carbon;
     */
    public $updatedAt;

    /**
     * @var Movie
     */
    public $movie;

    /**
     * @param $json
     * @param ClientId $id
     * @param AccessToken $token
     */
    public function __construct($json, ClientId $id, AccessToken $token)
    {
        $timestamp = date("u", strtotime($json->updated_at));
        $this->updatedAt = Carbon::createFromTimestamp($timestamp);
        $this->movie = new Movie($json, $id, $token);
    }
}