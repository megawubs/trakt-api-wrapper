<?php
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\My\NewShows;
use Wubs\Trakt\Request\Calendars\My\Shows;
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
        $request = new NewShows(get_token());

        $today = Carbon::today();
        $this->assertContains($today->format("Y-m-d"), (string)$request->getStartDate());
    }

    public function testCallShowsRequestWith14Days()
    {
        $request = new NewShows(get_token(), Carbon::today(), 14);

        $this->assertContains("14", (string)$request->getDays());
    }

    public function testWithDaysAndStartDate()
    {
        $startDate = Carbon::createFromFormat("Y-m-d", "2014-03-01");
        $request = new Shows(get_token(), $startDate, 25);

        $this->assertContains("25", (string)$request->getDays());
        $this->assertContains("2014-03-01", (string)$request->getStartDate());
    }
}
