<?php


use Carbon\Carbon;
use Wubs\Trakt\Api;
use Wubs\Trakt\Trakt;

class CalendarsRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $trakt;
    private $today;

    protected function setUp()
    {
        parent::setUp();
        $this->trakt = Trakt::api(getenv("CLIENT_ID"));
        $this->today = Carbon::today(new DateTimeZone("Europe/Amsterdam"));
    }

    public function testShows()
    {
        $res = $this->trakt->calendars->myShows(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testNewShows()
    {
        $res = $this->trakt->calendars->myNewShows(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testPremieres()
    {
        $res = $this->trakt->calendars->mySeasonPremieres(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testMovies()
    {
        $res = $this->trakt->calendars->myMovies(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testAllShows()
    {
        $res = $this->trakt->calendars->allShows($this->today, 7);

        $this->assertInternalType("array", $res);
    }
}
