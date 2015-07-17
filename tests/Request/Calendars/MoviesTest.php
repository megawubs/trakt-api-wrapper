<?php
use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\MyMovies;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Trakt;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:57
 */
class MoviesTest extends PHPUnit_Framework_TestCase
{

    public function testFormatsRequestUrl()
    {
        $startDate = Carbon::createFromFormat("Y-m-d", "2014-03-01");

        $request = new MyMovies(get_token(), $startDate, 25);

        $request->setToken(get_token());

        $formatted = $request->getUrl();

        $this->assertEquals("calendars/my/movies/2014-03-01/25", $formatted);
    }
}
