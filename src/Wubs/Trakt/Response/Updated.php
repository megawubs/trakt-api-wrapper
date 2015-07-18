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
use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Token\AccessToken;
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
     * @param $clientId
     * @param AccessToken $token
     * @param ClientInterface $client
     */
    public function __construct($json, $clientId, AccessToken $token, ClientInterface $client)
    {
        $timestamp = date("u", strtotime($json->updated_at));
        $this->updatedAt = Carbon::createFromTimestamp($timestamp);
        $this->movie = new Movie($json, $clientId, $token, $client);
    }
}