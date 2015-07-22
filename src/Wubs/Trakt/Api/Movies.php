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

use Wubs\Trakt\Request\Movies\Aliases as AliasesRequest;
use Wubs\Trakt\Request\Movies\Comments as CommentsRequest;
use Wubs\Trakt\Request\Movies\People as PeopleRequest;
use Wubs\Trakt\Request\Movies\Popular as PopularRequest;
use Wubs\Trakt\Request\Movies\Ratings as RatingsRequest;
use Wubs\Trakt\Request\Movies\Related as RelatedRequest;
use Wubs\Trakt\Request\Movies\Releases as ReleasesRequest;
use Wubs\Trakt\Request\Movies\Stats as StatsRequest;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Movies\Summary as SummaryRequest;
use Wubs\Trakt\Request\Movies\Translations as TranslationsRequest;
use Wubs\Trakt\Request\Movies\Trending as TrendingRequest;
use Wubs\Trakt\Request\Movies\Watching as WatchingRequest;

class Movies extends Endpoint {

    

    public function aliases($mediaId)
    {
        return $this->request(new AliasesRequest($mediaId));
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

	public function releases($mediaId, $country)
    {
        return $this->request(new ReleasesRequest($mediaId, $country));
    }

	public function stats($mediaId)
    {
        return $this->request(new StatsRequest($mediaId));
    }

	public function summary(AccessToken $token, $mediaId)
    {
        return $this->request(new SummaryRequest($token, $mediaId));
    }

	public function get(AccessToken $token, $mediaId)
    {
        return $this->request(new SummaryRequest($token, $mediaId));
    }

	public function translations($mediaId, $language)
    {
        return $this->request(new TranslationsRequest($mediaId, $language));
    }

	public function trending()
    {
        return $this->request(new TrendingRequest());
    }

	public function watching($id)
    {
        return $this->request(new WatchingRequest($id));
    }

}

