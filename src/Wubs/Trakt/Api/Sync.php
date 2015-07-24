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
use Wubs\Trakt\Request\Sync\LastActivities as LastActivitiesRequest;
use Wubs\Trakt\Request\Sync\Playback as PlaybackRequest;
use Wubs\Trakt\Request\Sync\Watched as WatchedRequest;

class Sync extends Endpoint {
    
    /**
     * @var \Wubs\Trakt\Api\Sync\Collection
    */
    public $collection;

    /**
     * @var \Wubs\Trakt\Api\Sync\History
    */
    public $history;

    /**
     * @var \Wubs\Trakt\Api\Sync\Ratings
    */
    public $ratings;

    /**
     * @var \Wubs\Trakt\Api\Sync\Watchlist
    */
    public $watchlist;

    public function lastActivities(AccessToken $token)
    {
        return $this->request(new LastActivitiesRequest($token));
    }

	public function playback(AccessToken $token, $type)
    {
        return $this->request(new PlaybackRequest($token, $type));
    }

	public function watched(AccessToken $token, $type)
    {
        return $this->request(new WatchedRequest($token, $type));
    }

}

