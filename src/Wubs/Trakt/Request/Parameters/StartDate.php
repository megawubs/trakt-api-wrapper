<?php namespace Wubs\Trakt\Request\Parameters;

use Carbon\Carbon;

class StartDate extends AbstractParameter implements Parameter
{
    /**
     * @var Carbon
     */
    protected $value;

    /**
     * @param Carbon $date
     */
    public function __construct(Carbon $date)
    {
        $this->value = $date;
    }

    public static function standard()
    {
        return new static(Carbon::today());
    }

    public function __toString()
    {
        return $this->value->format("Y-m-d");
    }
}