<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:52
 */

namespace Wubs\Trakt\Request;


use Carbon\Carbon;
use Wubs\Trakt\Request\Parameters\NumDays;
use Wubs\Trakt\Request\Parameters\StartDate;

trait TimePeriod
{

    private $startDate;

    private $days;

    /**
     * @param $startDate
     */
    protected function setStartDate(StartDate $startDate = null)
    {
        if (is_null($startDate)) {
            $startDate = StartDate::today();
        }

        $this->startDate = $startDate;
    }

    public function setDays(NumDays $days)
    {
        if (is_null($days)) {
            $days = NumDays::defaultDays();
        }

        $this->days = $days;
    }

    protected function getStartDate()
    {
        return $this->startDate;
    }

    protected function getDays()
    {
        return $this->days;
    }

}