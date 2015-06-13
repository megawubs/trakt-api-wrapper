<?php


namespace Wubs\Trakt\Request\Calendars;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\Parameters\TimePeriod;
use Wubs\Trakt\Request\RequestType;

class AllSeasonPremieres extends AbstractRequest
{
    use TimePeriod;

    public function __construct(AccessToken $accessToken, StartDate $startDate = null, Days $days = null)
    {
        parent::__construct();
        $this->setStartDate($startDate);
        $this->setDays($days);
        $this->setToken($accessToken);
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "calendars/all/shows/premieres/:start_date/:days";
    }
}