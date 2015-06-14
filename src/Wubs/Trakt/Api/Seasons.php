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

use Wubs\Trakt\Request\Seasons\Comments as CommentsRequest;
use Wubs\Trakt\Request\Seasons\Ratings as RatingsRequest;
use Wubs\Trakt\Request\Seasons\Season as SeasonRequest;
use Wubs\Trakt\Request\Seasons\Summary as SummaryRequest;
use Wubs\Trakt\Request\Seasons\Watching as WatchingRequest;

class Seasons extends Endpoint {

    public function comments($mediaId, $season)
    {
        return $this->request(new CommentsRequest($mediaId, $season));
    }

	public function ratings($mediaId, $season)
    {
        return $this->request(new RatingsRequest($mediaId, $season));
    }

	public function season($mediaId, $season)
    {
        return $this->request(new SeasonRequest($mediaId, $season));
    }

	public function summary($mediaId)
    {
        return $this->request(new SummaryRequest($mediaId));
    }

	public function get($mediaId)
    {
        return $this->request(new SummaryRequest($mediaId));
    }

	public function watching($mediaId, $season)
    {
        return $this->request(new WatchingRequest($mediaId, $season));
    }

}

