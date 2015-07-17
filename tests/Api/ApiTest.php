<?php


use Carbon\Carbon;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Mockery\Mock;
use Wubs\Trakt\Api;
use Wubs\Trakt\Response\CheckIn;
use Wubs\Trakt\Trakt;

class ApiTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Api
     */
    protected $trakt;

    /**
     * @var Carbon
     */
    protected $today;

    protected function tearDown()
    {
        Mockery::close();
    }

    protected function setUp()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);

        $this->trakt = new Trakt(get_client_id(), $client);

        $this->today = Carbon::today(new DateTimeZone("Europe/Amsterdam"));
    }


    public function testCalendars()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $client->shouldReceive("send")->once()->andReturn($response);

        $trakt = new Trakt(get_client_id(), $client);

        $calendars = $trakt->calendars;

        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Calendars", $calendars);

        $movies = $calendars->allMovies($this->today, 7);
        $this->assertInternalType('array', $movies);
    }

    public function testCheckIn()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn(
            new CheckIn(
                json_decode(
                    '{
  "watched_at": "2014-08-06T01:11:37.953Z",
  "sharing": {
    "facebook": true,
    "twitter": true,
    "tumblr": false
  },
  "movie": {
    "title": "Guardians of the Galaxy",
    "year": 2014,
    "ids": {
      "trakt": 28,
      "slug": "guardians-of-the-galaxy-2014",
      "imdb": "tt2015381",
      "tmdb": 118340
    }
  }
}'
                ), get_client_id(), get_token()
            )
        );

        $client->shouldReceive("send")->once()->andReturn($response);

        $trakt = new Trakt(get_client_id(), $client);

        $checkIn = $trakt->checkIn;
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\CheckIn", $checkIn);
//
        $response = $checkIn->create(
            get_token(),
            movie(),
            [
                'facebook' => false,
                'twitter' => false,
                'tumblr' => false
            ],
            "nooo way!",
            "1200",
            "blablabla",
            "1.1",
            $this->today->format("Y-m-d")
        );
        $this->assertInstanceOf("Wubs\\Trakt\\Response\\CheckIn", $response);
    }

    public function testComments()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Comments", $this->trakt->comments);
    }

    public function testEpisodes()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Episodes", $this->trakt->episodes);
    }

    public function testGenres()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Genres", $this->trakt->genres);
    }

    public function testMovies()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Movies", $this->trakt->movies);
    }

    public
    function testPeople()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\People", $this->trakt->people);
    }

    public
    function testRecommendations()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Recommendations", $this->trakt->recommendations);
    }

    public
    function testScrobble()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Scrobble", $this->trakt->scrobble);
    }

    public
    function testSearch()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Search", $this->trakt->search);
    }

    public
    function testSeasons()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Seasons", $this->trakt->seasons);
    }

    public
    function testShows()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Shows", $this->trakt->shows);
    }

    public
    function testUsers()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Users", $this->trakt->users);
    }
}
