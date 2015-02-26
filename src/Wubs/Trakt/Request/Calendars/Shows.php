<?php namespace Wubs\Trakt\Request\Calendars;

use Carbon\Carbon;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Request\StartDate;
use Wubs\Trakt\Response\Calendars\Shows as ShowsResponse;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 15:10
 */
class Shows extends AbstractRequest
{
    use StartDate;

    /**
     * @param bool $startDate
     * @param int $days
     */
    public function __construct($days = 7, $startDate = false)
    {
        $this->days = $days;
        $this->setStartDate($startDate);

        parent::__construct();
    }

    protected function getResponseHandler()
    {
        return ShowsResponse::class;
    }


    public function getMethod()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "calendars/shows/" . $this->getStartDate() . "/" . $this->getDays();
    }


}