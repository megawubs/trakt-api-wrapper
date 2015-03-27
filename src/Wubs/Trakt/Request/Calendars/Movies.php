<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:48
 */

namespace Wubs\Trakt\Request\Calendars;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\Parameters\TimePeriod;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Calendars\MoviesHandler;

class Movies extends AbstractRequest
{
    use TimePeriod;

    public function __construct(StartDate $startDate = null, Days $days = null)
    {
        parent::__construct();
        $this->setStartDate($startDate);
        $this->setDays($days);

        $this->setResponseHandler(new MoviesHandler());
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "calendars/movies/:start_date/:days";
    }
}