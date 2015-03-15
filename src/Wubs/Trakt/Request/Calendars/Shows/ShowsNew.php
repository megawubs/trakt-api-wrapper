<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:14
 */

namespace Wubs\Trakt\Request\Calendars\Shows;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Request\TimePeriod;
use Wubs\Trakt\Response\Handlers\Calendars\Shows;

class ShowsNew extends AbstractRequest
{

    use TimePeriod;

    public function __construct(StartDate $startDate = null, Days $days = null)
    {
        parent::__construct();
        $this->setStartDate($startDate);
        $this->setDays($days);
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "calendars/shows/new/" . $this->getStartDate() . "/" . $this->getDays();
    }

    protected function getResponseHandler()
    {
        return Shows::class;
    }
}