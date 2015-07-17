<?php
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\MyNewShows;
use Wubs\Trakt\Request\Calendars\ShowsPremieres;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:35
 */
class PremieresTest extends PHPUnit_Framework_TestCase
{
    public function testUriContainsParameters()
    {
        $date = Carbon::now()->subYears(3);
        $request = new MyNewShows(get_token(), $date, 500);

        $uri = $request->getUrl();

        $this->assertContains($date->format("Y-m-d"), $uri);
        $this->assertContains("500", $uri);
    }
}
