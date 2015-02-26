<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:52
 */

namespace Wubs\Trakt\Request;


use Carbon\Carbon;

trait StartDate
{

    private $startDate;

    private $days;

    /**
     * @param $startDate
     */
    protected function setStartDate($startDate)
    {
        if (!$startDate) {
            $startDate = Carbon::today()->format("Y-m-d");
        }
        $this->startDate = $startDate;
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