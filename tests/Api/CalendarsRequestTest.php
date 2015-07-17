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

    public function tearDown()
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
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("json")->once()->andReturn([]);
        $trakt = new Trakt(getenv("CLIENT_ID"), $client);

        $res = $trakt->calendars->myShows(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testNewShows()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("json")->once()->andReturn([]);
        $trakt = new Trakt(getenv("CLIENT_ID"), $client);

        $res = $trakt->calendars->myNewShows(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testPremieres()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("json")->once()->andReturn([]);
        $trakt = new Trakt(getenv("CLIENT_ID"), $client);

        $res = $trakt->calendars->mySeasonPremieres(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testMovies()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("json")->once()->andReturn([]);
        $trakt = new Trakt(getenv("CLIENT_ID"), $client);

        $res = $trakt->calendars->myMovies(get_token(), $this->today, 7);

        $this->assertInternalType("array", $res);
    }

    public function testAllShows()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("json")->once()->andReturn([]);
        $trakt = new Trakt(getenv("CLIENT_ID"), $client);

        $res = $trakt->calendars->allShows($this->today, 7);

        $this->assertInternalType("array", $res);
    }
}
