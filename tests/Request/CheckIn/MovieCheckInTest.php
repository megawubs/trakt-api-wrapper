<?php
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\CheckIn\MovieCheckIn;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\RequestType;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 19:26
 */
class MovieCheckInTest extends PHPUnit_Framework_TestCase
{
    public function testStaticCall()
    {
        $request = new MovieCheckIn(movie());

        $url = $request->getUrl();

        $type = $request->getRequestType();

        $this->assertEquals(RequestType::POST, $type);
        $this->assertEquals("checkin", $url);
    }
}
