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

use Wubs\Trakt\Request\Shows\Aliases as RequestAliases;
use Wubs\Trakt\Request\Shows\CollectionProgress as RequestCollectionProgress;
use Wubs\Trakt\Request\Shows\Comments as RequestComments;
use Wubs\Trakt\Request\Shows\People as RequestPeople;
use Wubs\Trakt\Request\Shows\Popular as RequestPopular;
use Wubs\Trakt\Request\Shows\Ratings as RequestRatings;
use Wubs\Trakt\Request\Shows\Related as RequestRelated;
use Wubs\Trakt\Request\Shows\Stats as RequestStats;
use Wubs\Trakt\Request\Shows\Summary as RequestSummary;
use Wubs\Trakt\Request\Shows\Translations as RequestTranslations;
use Wubs\Trakt\Request\Shows\Trending as RequestTrending;
use Carbon\Carbon;
use Wubs\Trakt\Request\Shows\Updates as RequestUpdates;
use Wubs\Trakt\Request\Shows\WatchedProgress as RequestWatchedProgress;
use Wubs\Trakt\Request\Shows\Watching as RequestWatching;

class Shows extends Endpoint {

    public function aliases( $mediaId)
    {
        return $this->request(new RequestAliases($mediaId));
    }

	public function collectionProgress( $mediaId)
    {
        return $this->request(new RequestCollectionProgress($mediaId));
    }

	public function comments( $mediaId)
    {
        return $this->request(new RequestComments($mediaId));
    }

	public function people( $mediaId)
    {
        return $this->request(new RequestPeople($mediaId));
    }

	public function popular( $queryParams)
    {
        return $this->request(new RequestPopular($queryParams));
    }

	public function ratings( $mediaId)
    {
        return $this->request(new RequestRatings($mediaId));
    }

	public function related( $mediaId)
    {
        return $this->request(new RequestRelated($mediaId));
    }

	public function stats( $mediaId)
    {
        return $this->request(new RequestStats($mediaId));
    }

	public function summary( $mediaId)
    {
        return $this->request(new RequestSummary($mediaId));
    }

	public function get( $mediaId)
    {
        return $this->request(new RequestSummary($mediaId));
    }

	public function translations( $mediaId,  $language)
    {
        return $this->request(new RequestTranslations($mediaId, $language));
    }

	public function trending( $queryParams)
    {
        return $this->request(new RequestTrending($queryParams));
    }

	public function updates(Carbon $date)
    {
        return $this->request(new RequestUpdates($date));
    }

	public function watchedProgress( $mediaId)
    {
        return $this->request(new RequestWatchedProgress($mediaId));
    }

	public function watching( $mediaId)
    {
        return $this->request(new RequestWatching($mediaId));
    }

}

