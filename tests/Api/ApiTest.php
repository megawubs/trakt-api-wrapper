<?php


use Carbon\Carbon;
use Wubs\Trakt\Api;
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

    protected function setUp()
    {
        $this->trakt = Trakt::api(get_client_id());
        $this->today = Carbon::today(new DateTimeZone("Europe/Amsterdam"));
    }


    public function testCalendars()
    {
        $calendars = $this->trakt->calendars;
        $today = $this->today;
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Calendars", $calendars);

        $movies = $calendars->allMovies($today, 7);
        $this->assertInternalType('array', $movies);

        $shows = $calendars->allNewShows($today, 7);
        $this->assertInternalType('array', $shows);

        $premieres = $calendars->allSeasonPremieres($today, 7);
        $this->assertInternalType('array', $premieres);

        $allShows = $calendars->allShows($today, 7);
        $this->assertInternalType('array', $allShows);

        $myMovies = $calendars->myMovies(get_token(), $today, 7);
        $this->assertInternalType('array', $myMovies);

        $myShows = $calendars->myShows(get_token(), $today, 7);
        $this->assertInternalType('array', $myShows);

        $myNewShows = $calendars->myNewShows(get_token(), $today, 7);
        $this->assertInternalType('array', $myNewShows);

        $mySeasonPremieres = $calendars->mySeasonPremieres(get_token(), $today, 7);
        $this->assertInternalType('array', $mySeasonPremieres);
    }

    public function testCheckIn()
    {
        $checkIn = $this->trakt->checkIn;
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\CheckIn", $checkIn);

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

        $this->assertTrue($checkIn->delete(get_token()));
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

    public function testPeople()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\People", $this->trakt->people);
    }

    public function testRecommendations()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Recommendations", $this->trakt->recommendations);
    }

    public function testScrobble()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Scrobble", $this->trakt->scrobble);
    }

    public function testSearch()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Search", $this->trakt->search);
    }

    public function testSeasons()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Seasons", $this->trakt->seasons);
    }

    public function testShows()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Shows", $this->trakt->shows);
    }

    public function testUsers()
    {
        $this->assertInstanceOf("Wubs\\Trakt\\Api\\Users", $this->trakt->users);
    }
}
