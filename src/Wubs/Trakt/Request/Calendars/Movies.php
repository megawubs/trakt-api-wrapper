<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:48
 */

namespace Wubs\Trakt\Request\Calendars;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Request\StartDate;

class Movies extends AbstractRequest
{
    use StartDate;

    public function __construct($startDate = false, $days = 7)
    {
        $this->setStartDate($startDate);
        $this->days = $days;

        parent::__construct();
    }

    public function getMethod()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "calendars/movies/" . $this->getStartDate() . "/" . $this->getDays();
    }
}