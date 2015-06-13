<?php
use Wubs\Trakt\Request\Calendars\MyMovies;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Username;
use Wubs\Trakt\Request\Users\History;

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
        $result = (new MyMovies(StartDate::standard(), Days::standard()))->make(
            get_client_id(),
            get_token()
        );

        $this->assertInstanceOf(Wubs\Trakt\Response\Calendar\Calendar::class, $result);
    }

    public function testRequestWithoutToken()
    {
        $response = (new History(Username::set('megawubs'), Type::movies()))->make(get_client_id());

        $this->assertInternalType("array", $response);

    }


}
