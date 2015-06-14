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

use Wubs\Trakt\Request\Movies\Aliases as RequestAliases;
use Wubs\Trakt\Request\Movies\Comments as RequestComments;
use Wubs\Trakt\Request\Movies\People as RequestPeople;
use Wubs\Trakt\Request\Movies\Popular as RequestPopular;
use Wubs\Trakt\Request\Movies\Ratings as RequestRatings;
use Wubs\Trakt\Request\Movies\Related as RequestRelated;
use Wubs\Trakt\Request\Movies\Releases as RequestReleases;
use Wubs\Trakt\Request\Movies\Stats as RequestStats;
use Wubs\Trakt\Request\Movies\Summary as RequestSummary;
use Wubs\Trakt\Request\Movies\Translations as RequestTranslations;
use Wubs\Trakt\Request\Movies\Trending as RequestTrending;
use Wubs\Trakt\Request\Movies\Watching as RequestWatching;

class Movies extends Endpoint {

    public function aliases( $mediaId)
    {
        return $this->request(new RequestAliases($mediaId));
    }

	public function comments( $mediaId)
    {
        return $this->request(new RequestComments($mediaId));
    }

	public function people( $mediaId)
    {
        return $this->request(new RequestPeople($mediaId));
    }

	public function popular()
    {
        return $this->request(new RequestPopular());
    }

	public function ratings( $mediaId)
    {
        return $this->request(new RequestRatings($mediaId));
    }

	public function related( $mediaId)
    {
        return $this->request(new RequestRelated($mediaId));
    }

	public function releases( $mediaId,  $country)
    {
        return $this->request(new RequestReleases($mediaId, $country));
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

	public function trending()
    {
        return $this->request(new RequestTrending());
    }

	public function watching( $id)
    {
        return $this->request(new RequestWatching($id));
    }

}

