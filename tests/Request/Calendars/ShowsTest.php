<?php
use Wubs\Trakt\Request\Calendars\Shows;
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

        $this->assertContains("2015-02-25", $request->getUrl());
    }

    public function testCallShowsRequestWith14Days()
    {
        $request = new Shows(14);
        $request->setToken(get_token());

        $this->assertContains("14", $request->getUrl());
    }

    public function testWithDaysAndStartDate()
    {
        $request = new Shows(25, "2014-03-01");
        $request->setToken(get_token());

        $this->assertContains("25", $request->getUrl());
        $this->assertContains("2014-03-01", $request->getUrl());
    }

    public function testCanCallRequest()
    {
        $request = new Shows(25, "2014-03-01");
        $request->setToken(get_token());

        $trakt = new Trakt(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $response = $trakt->call($request);

        $this->assertEquals("Shows", $response);
    }
}
