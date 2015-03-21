<?php
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\Shows\ShowsNew;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:17
 */
class ShowsNewTest extends PHPUnit_Framework_TestCase
{

    public function testStaticCall()
    {
        $startDate = Carbon::now()->subYears(3);
        $request = new ShowsNew(new StartDate($startDate), Days::set(500));

        $url = $request->getUrl();

        $this->assertEquals("calendars/shows/new/" . $startDate->format("Y-m-d") . "/500", $url);

    }
}
