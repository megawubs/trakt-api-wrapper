<?php

use Wubs\Trakt\Api;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Trakt;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

class MoviesRequestTest extends PHPUnit_Framework_TestCase
{
    protected $trakt;

    protected $id = "tron-legacy-2010";

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testAliases()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $aliases = $trakt->movies->aliases($this->id);

        $this->assertInternalType("object", $aliases);
    }

    public function testComments()
    {
        $auth = mock_auth();

        $trakt = new Trakt($auth, mock_client(200, "[]"));

        $comments = $trakt->movies->comments($this->id, get_token());

        $this->assertInternalType("object", $comments);
    }

    public function testPeople()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $people = $trakt->movies->people($this->id);

        $this->assertInternalType("object", $people);
    }

    public function testPopular()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $popular = $trakt->movies->popular();

        $this->assertInternalType("object", $popular);
    }

    public function testRatings()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $ratings = $trakt->movies->ratings($this->id);

        $this->assertInternalType("object", $ratings);
    }

    public function testReleases()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $ratings = $trakt->movies->releases($this->id, "NL");

        $this->assertInternalType("object", $ratings);
    }

    public function testRelated()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->movies->related($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testStats()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $stats = $trakt->movies->stats($this->id);

        $this->assertInternalType("object", $stats);
    }

    public function testSummary()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, movieJson()));

        $res = $trakt->movies->summary(get_token(), $this->id);
        $this->assertInstanceOf(Movie::class, $res);
    }

    public function testTranslations()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->movies->translations($this->id, "NL");

        $this->assertInternalType("object", $res);
    }

    public function testTrending()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->movies->trending(get_token());

        $this->assertInternalType("object", $res);
    }

    public function testWatching()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->movies->watching($this->id);

        $this->assertInternalType("object", $res);
    }
}
