<?php


namespace Wubs\Trakt\Request\Calendars;


use Carbon\Carbon;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\TimePeriod;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\DefaultResponseHandler;

class AllMovies extends AbstractRequest
{
    use TimePeriod;

    public function __construct(Carbon $startDate = null, $days = null)
    {
        parent::__construct();
        $this->setStartDate($startDate);
        $this->setDays($days);
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "calendars/all/movies/:start_date/:days";
    }
}