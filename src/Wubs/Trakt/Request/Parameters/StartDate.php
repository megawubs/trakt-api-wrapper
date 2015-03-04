<?php namespace Wubs\Trakt\Request\Parameters;

use Carbon\Carbon;

class StartDate implements Parameter
{
    /**
     * @var Carbon
     */
    private $date;

    /**
     * @param Carbon $date
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    public static function standard()
    {
        return new static(Carbon::today());
    }

    public function __toString()
    {
        return $this->date->format("Y-m-d");
    }
}