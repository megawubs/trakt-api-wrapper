<?php


use Carbon\Carbon;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Api;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Trakt;

class CalendarsRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $trakt;
    private $today;

    protected function tearDown()
    {
        Mockery::close();
    }

    protected function setUp()
    {
        parent::setUp();
        $this->today = Carbon::today(new DateTimeZone("Europe/Amsterdam"));
    }

    public function testShows()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->calendars->myShows(get_token(), $this->today, 7);

        $this->assertInternalType("object", $res);
    }

    public function testNewShows()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->calendars->myNewShows(get_token(), $this->today, 7);

        $this->assertInternalType("object", $res);
    }

    public function testPremieres()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->calendars->mySeasonPremieres(get_token(), $this->today, 7);

        $this->assertInternalType("object", $res);
    }

    public function testMovies()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->calendars->myMovies(get_token(), $this->today, 7);

        $this->assertInternalType("object", $res);
    }

    public function testAllShows()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->calendars->allShows(get_token(), $this->today, 7);

        $this->assertInternalType("object", $res);
    }
}
