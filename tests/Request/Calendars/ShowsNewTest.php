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
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $response = ShowsNew::request($id, $token, new StartDate(Carbon::now()->subYears(3)), Days::set(500));
        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Episode", $response[0]);
    }
}
