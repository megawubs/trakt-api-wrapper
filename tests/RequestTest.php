<?php
use Wubs\Trakt\Request\Calendars\Movies;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/03/15
 * Time: 19:35
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    public function testCanMakeRequest()
    {
        $result = Movies::request(get_client_id(), get_token());

        $this->assertInstanceOf(Wubs\Trakt\Response\Calendar\Calendar::class, $result);
    }
}
