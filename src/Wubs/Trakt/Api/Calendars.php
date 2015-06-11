<?php


namespace Wubs\Trakt\Api;


use Carbon\Carbon;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Calendars\AllShows;
use Wubs\Trakt\Request\Calendars\Movies as MoviesRequest;
use Wubs\Trakt\Request\Calendars\Shows as ShowsRequest;
use Wubs\Trakt\Request\Parameters\StartDate;

class Calendars extends Endpoint
{
    /**
     * @param AccessToken $token
     * @param Carbon $startDate
     * @param null $days
     * @return mixed
     */
    public function shows(AccessToken $token, Carbon $startDate = null, $days = null)
    {
        $startDate = ($startDate === null) ? null : StartDate::set($startDate);
        return $this->request(new ShowsRequest($startDate, $days), $token);
    }

    /**
     * @param AccessToken $token
     * @param Carbon $startDate
     * @param null $days
     * @return mixed
     */
    public function newShows(AccessToken $token, Carbon $startDate = null, $days = null)
    {
        $startDate = ($startDate === null) ? null : StartDate::set($startDate);
        return $this->request(new ShowsRequest\ShowsNew($startDate, $days), $token);
    }

    /**
     * @param AccessToken $token
     * @param Carbon $startDate
     * @param null $days
     * @return mixed
     */
    public function seasonPremieres(AccessToken $token, Carbon $startDate = null, $days = null)
    {
        $startDate = ($startDate === null) ? null : StartDate::set($startDate);
        return $this->request(new ShowsRequest\Premieres($startDate, $days), $token);
    }

    /**
     * @param AccessToken $token
     * @param Carbon $startDate
     * @param null $days
     * @return mixed
     */
    public function movies(AccessToken $token, Carbon $startDate = null, $days = null)
    {
        $startDate = ($startDate === null) ? null : StartDate::set($startDate);
        return $this->request(new MoviesRequest($startDate, $days), $token);
    }

    /**
     * @param Carbon $startDate
     * @param null $days
     * @return mixed
     */
    public function allShows(Carbon $startDate = null, $days = null)
    {
        $startDate = ($startDate === null) ? null : StartDate::set($startDate);
        return $this->request(new AllShows($startDate, $days));
    }
}