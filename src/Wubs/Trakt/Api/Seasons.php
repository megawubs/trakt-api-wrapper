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

use Wubs\Trakt\Request\Seasons\Comments as RequestComments;
use Wubs\Trakt\Request\Seasons\Ratings as RequestRatings;
use Wubs\Trakt\Request\Seasons\Season as RequestSeason;
use Wubs\Trakt\Request\Seasons\Summary as RequestSummary;
use Wubs\Trakt\Request\Seasons\Watching as RequestWatching;

class Seasons extends Endpoint {

    public function comments( $mediaId,  $season)
    {
        return $this->request(new RequestComments($mediaId, $season));
    }

	public function ratings( $mediaId,  $season)
    {
        return $this->request(new RequestRatings($mediaId, $season));
    }

	public function season( $mediaId,  $season)
    {
        return $this->request(new RequestSeason($mediaId, $season));
    }

	public function summary( $mediaId)
    {
        return $this->request(new RequestSummary($mediaId));
    }

	public function get( $mediaId)
    {
        return $this->request(new RequestSummary($mediaId));
    }

	public function watching( $mediaId,  $season)
    {
        return $this->request(new RequestWatching($mediaId, $season));
    }

}

