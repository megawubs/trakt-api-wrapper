<?php


use Wubs\Trakt\Api;
use Wubs\Trakt\Trakt;

class CalendarsRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $trakt;

    protected function setUp()
    {
        parent::setUp();
        $this->trakt = Trakt::api(getenv("CLIENT_ID"));
    }

    public function testShows()
    {
        $res = $this->trakt->calendars->shows(get_token());

        $this->assertInternalType("array", $res);
    }

    public function testNewShows()
    {
        $res = $this->trakt->calendars->newShows(get_token());

        $this->assertInternalType("array", $res);
    }

    public function testPremieres()
    {
        $res = $this->trakt->calendars->seasonPremieres(get_token());

        $this->assertInternalType("array", $res);
    }

    public function testMovies()
    {
        $res = $this->trakt->calendars->movies(get_token());

        $this->assertInternalType("object", $res);
    }

    public function testAllShows()
    {
        $res = $this->trakt->calendars->allShows();

        $this->assertInternalType("array", $res);
    }
}
