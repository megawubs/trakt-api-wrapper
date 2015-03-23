<?php
use Wubs\Trakt\Request\Calendars\Movies;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;

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
        $parameters = [
            StartDate::standard(),
            Days::standard()
        ];
        $result = Movies::request(get_client_id(), get_token(), $parameters);

        $this->assertInstanceOf(Wubs\Trakt\Response\Calendar\Calendar::class, $result);
    }


}
