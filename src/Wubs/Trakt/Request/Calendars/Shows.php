<?php namespace Wubs\Trakt\Request\Calendars;

use Carbon\Carbon;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Request\TimePeriod;
use Wubs\Trakt\Response\Calendars\Shows as ShowsResponse;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 15:10
 */
class Shows extends AbstractRequest
{
    use TimePeriod;

    /**
     * @param StartDate $startDate
     * @param Days $days
     */
    public function __construct(StartDate $startDate = null, Days $days = null)
    {
        $this->setDays($days);
        $this->setStartDate($startDate);

        parent::__construct();
    }

    protected
    function getResponseHandler()
    {
        return ShowsResponse::class;
    }

    public
    function getMethod()
    {
        return RequestType::GET;
    }

    public
    function getUrl()
    {
        return "calendars/shows/" . $this->getStartDate() . "/" . $this->getDays();
    }


}