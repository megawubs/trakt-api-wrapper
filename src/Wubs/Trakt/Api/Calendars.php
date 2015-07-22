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

use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\AllMovies as AllMoviesRequest;
use Wubs\Trakt\Request\Calendars\AllNewShows as AllNewShowsRequest;
use Wubs\Trakt\Request\Calendars\AllSeasonPremieres as AllSeasonPremieresRequest;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Calendars\AllShows as AllShowsRequest;
use Wubs\Trakt\Request\Calendars\MyMovies as MyMoviesRequest;
use Wubs\Trakt\Request\Calendars\MyNewShows as MyNewShowsRequest;
use Wubs\Trakt\Request\Calendars\MySeasonPremieres as MySeasonPremieresRequest;
use Wubs\Trakt\Request\Calendars\MyShows as MyShowsRequest;

class Calendars extends Endpoint {

    

    public function allMovies(Carbon $startDate = null, $days = null)
    {
        return $this->request(new AllMoviesRequest($startDate, $days));
    }

	public function allNewShows(Carbon $startDate = null, $days = null)
    {
        return $this->request(new AllNewShowsRequest($startDate, $days));
    }

	public function allSeasonPremieres(Carbon $startDate = null, $days = null)
    {
        return $this->request(new AllSeasonPremieresRequest($startDate, $days));
    }

	public function allShows(AccessToken $token, Carbon $startDate = null, $days = null)
    {
        return $this->request(new AllShowsRequest($token, $startDate, $days));
    }

	public function myMovies(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new MyMoviesRequest($accessToken, $startDate, $days));
    }

	public function myNewShows(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new MyNewShowsRequest($accessToken, $startDate, $days));
    }

	public function mySeasonPremieres(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new MySeasonPremieresRequest($accessToken, $startDate, $days));
    }

	public function myShows(AccessToken $accessToken, Carbon $startDate = null, $days = null)
    {
        return $this->request(new MyShowsRequest($accessToken, $startDate, $days));
    }

}

