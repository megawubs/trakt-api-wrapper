<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:52
 */

namespace Wubs\Trakt\Request;


use Carbon\Carbon;
use Wubs\Trakt\Request\Parameters\Days;
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
            $startDate = StartDate::standard();
        }

        $this->startDate = $startDate;
    }

    public function setDays(Days $days = null)
    {
        if (is_null($days)) {
            $days = Days::standard();
        }

        $this->days = $days;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getDays()
    {
        return $this->days;
    }

}