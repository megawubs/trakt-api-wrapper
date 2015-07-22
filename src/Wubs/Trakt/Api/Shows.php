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

use Wubs\Trakt\Request\Shows\Aliases as AliasesRequest;
use Wubs\Trakt\Request\Shows\CollectionProgress as CollectionProgressRequest;
use Wubs\Trakt\Request\Shows\Comments as CommentsRequest;
use Wubs\Trakt\Request\Shows\People as PeopleRequest;
use Wubs\Trakt\Request\Shows\Popular as PopularRequest;
use Wubs\Trakt\Request\Shows\Ratings as RatingsRequest;
use Wubs\Trakt\Request\Shows\Related as RelatedRequest;
use Wubs\Trakt\Request\Shows\Stats as StatsRequest;
use Wubs\Trakt\Request\Shows\Summary as SummaryRequest;
use Wubs\Trakt\Request\Shows\Translations as TranslationsRequest;
use Wubs\Trakt\Request\Shows\Trending as TrendingRequest;
use Carbon\Carbon;
use Wubs\Trakt\Request\Shows\Updates as UpdatesRequest;
use Wubs\Trakt\Request\Shows\WatchedProgress as WatchedProgressRequest;
use Wubs\Trakt\Request\Shows\Watching as WatchingRequest;

class Shows extends Endpoint {

    

    public function aliases($mediaId)
    {
        return $this->request(new AliasesRequest($mediaId));
    }

	public function collectionProgress($mediaId)
    {
        return $this->request(new CollectionProgressRequest($mediaId));
    }

	public function comments($mediaId)
    {
        return $this->request(new CommentsRequest($mediaId));
    }

	public function people($mediaId)
    {
        return $this->request(new PeopleRequest($mediaId));
    }

	public function popular()
    {
        return $this->request(new PopularRequest());
    }

	public function ratings($mediaId)
    {
        return $this->request(new RatingsRequest($mediaId));
    }

	public function related($mediaId)
    {
        return $this->request(new RelatedRequest($mediaId));
    }

	public function stats($mediaId)
    {
        return $this->request(new StatsRequest($mediaId));
    }

	public function summary($mediaId)
    {
        return $this->request(new SummaryRequest($mediaId));
    }

	public function get($mediaId)
    {
        return $this->request(new SummaryRequest($mediaId));
    }

	public function translations($mediaId, $language)
    {
        return $this->request(new TranslationsRequest($mediaId, $language));
    }

	public function trending()
    {
        return $this->request(new TrendingRequest());
    }

	public function updates(Carbon $date = null)
    {
        return $this->request(new UpdatesRequest($date));
    }

	public function watchedProgress($mediaId)
    {
        return $this->request(new WatchedProgressRequest($mediaId));
    }

	public function watching($mediaId)
    {
        return $this->request(new WatchingRequest($mediaId));
    }

}

