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

    public function testCanCallRequestWithNoParameters()
    {
        $request = new Shows();
        $request->setToken(get_token());
        $today = (string)StartDate::standard();
        $this->assertContains($today, $request->getUrl());
    }

    public function testCallShowsRequestWith14Days()
    {
        $request = new Shows(null, Days::num(14));
        $request->setToken(get_token());

        $this->assertContains("14", $request->getUrl());
    }

    public function testWithDaysAndStartDate()
    {
        $startDate = new StartDate(Carbon::createFromFormat("Y-m-d", "2014-03-01"));
        $request = new Shows($startDate, Days::num(25));
        $request->setToken(get_token());

        $this->assertContains("25", $request->getUrl());
        $this->assertContains("2014-03-01", $request->getUrl());
    }

    public function testCanCallRequest()
    {
        $startDate = new StartDate(Carbon::createFromFormat("Y-m-d", "2014-03-01"));
        $request = new Shows($startDate, Days::num(25));
        $request->setToken(get_token());

        $trakt = new Trakt(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $response = $trakt->call($request);

        $this->assertInternalType("array", $response);
    }

    public function testStaticRequest()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $response = Shows::request($id, $token, StartDate::standard(), Days::num(1));
        print_r($response);
        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Show", $response[0]);
    }
}
