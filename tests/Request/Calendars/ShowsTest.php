<?php
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\Shows;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Trakt;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 15:19
 */
class ShowsTest extends PHPUnit_Framework_TestCase
{

    public function testCanBuildRequestWithNoParameters()
    {
        $request = new Shows();
        $request->setToken(get_token());
        $today = (string)StartDate::standard();
        $this->assertContains($today, (string)$request->getStartDate());
    }

    public function testCallShowsRequestWith14Days()
    {
        $request = new Shows(null, Days::set(14));
        $request->setToken(get_token());

        $this->assertContains("14", (string)$request->getDays());
    }

    public function testWithDaysAndStartDate()
    {
        $startDate = new StartDate(Carbon::createFromFormat("Y-m-d", "2014-03-01"));
        $request = new Shows($startDate, Days::set(25));
        $request->setToken(get_token());

        $this->assertContains("25", (string)$request->getDays());
        $this->assertContains("2014-03-01", (string)$request->getStartDate());
    }
}
