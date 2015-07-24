<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Calendars;

use League\OAuth2\Client\Token\AccessToken;
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\My\Movies as MoviesRequest;
use Wubs\Trakt\Request\Calendars\My\NewShows as NewShowsRequest;
use Wubs\Trakt\Request\Calendars\My\Premieres as PremieresRequest;
use Wubs\Trakt\Request\Calendars\My\Shows as ShowsRequest;
use Wubs\Trakt\Api\Endpoint;

class My extends Endpoint {
    


    public function movies(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new MoviesRequest($accessToken, $startDate, $days));
    }

	public function newShows(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new NewShowsRequest($accessToken, $startDate, $days));
    }

	public function premieres(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new PremieresRequest($accessToken, $startDate, $days));
    }

	public function shows(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new ShowsRequest($accessToken, $startDate, $days));
    }

}

