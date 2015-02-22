<?php
use Wubs\Trakt\Request;
use Wubs\Trakt\TraktToken;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 16:09
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    public static $token;

    public static function setUpBeforeClass()
    {
        static::$token = get_token();
    }


    public function testCreateCalendarsShowsUrl()
    {
        $request = (new Request())->create(, "calendars/shows", static::$token);

        $this->assertInstanceOf("\\Wubs\\Trakt\\Request", $request);
        $this->assertEquals("GET", $request->getRequest()->getMethod());
        $this->assertEquals("/calendars/shows", $request->getRequest()->getPath());
    }

    public function testCanSetOptionalParametersToApiUrl()
    {
        $request = (new Request())->create(, "calendars/shows", static::$token, ["2014-09-01", "7"]);

        $this->assertEquals("/calendars/shows/2014-09-01/7", $request->getRequest()->getPath());
    }

    public function testCanMakeRequest()
    {
        $request = (new Request())->create(, "calendars/shows", static::$token, ["2014-09-01", "7"]);
        $response = $request->send();

        $this->assertInternalType("array", $response);
    }
}
