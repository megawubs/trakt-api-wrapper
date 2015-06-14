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

use Wubs\Trakt\Request\Episodes\Comments as RequestComments;
use Wubs\Trakt\Request\Episodes\Ratings as RequestRatings;
use Wubs\Trakt\Request\Episodes\Stats as RequestStats;
use Wubs\Trakt\Request\Episodes\Summary as RequestSummary;
use Wubs\Trakt\Request\Episodes\Watching as RequestWatching;

class Episodes extends Endpoint {

    public function comments( $commentId,  $season,  $episode)
    {
        return $this->request(new RequestComments($commentId, $season, $episode));
    }

	public function ratings( $mediaId,  $season,  $episode)
    {
        return $this->request(new RequestRatings($mediaId, $season, $episode));
    }

	public function stats( $mediaId,  $season,  $episode)
    {
        return $this->request(new RequestStats($mediaId, $season, $episode));
    }

	public function summary( $mediaId,  $season,  $episode)
    {
        return $this->request(new RequestSummary($mediaId, $season, $episode));
    }

	public function get( $mediaId,  $season,  $episode)
    {
        return $this->request(new RequestSummary($mediaId, $season, $episode));
    }

	public function watching( $mediaId,  $season,  $episode)
    {
        return $this->request(new RequestWatching($mediaId, $season, $episode));
    }

}

