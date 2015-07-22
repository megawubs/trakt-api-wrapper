<?php


use Wubs\Trakt\Api;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Trakt;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

class MoviesRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
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
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $aliases = $trakt->movies->aliases($this->id);

        $this->assertInternalType("object", $aliases);
    }

    public function testComments()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $comments = $trakt->movies->comments($this->id, get_token());

        $this->assertInternalType("object", $comments);
    }

    public function testPeople()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $people = $trakt->movies->people($this->id);

        $this->assertInternalType("object", $people);
    }

    public function testPopular()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $popular = $trakt->movies->popular();

        $this->assertInternalType("object", $popular);
    }

    public function testRatings()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $ratings = $trakt->movies->ratings($this->id);

        $this->assertInternalType("object", $ratings);
    }

    public function testReleases()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $ratings = $trakt->movies->releases($this->id, "NL");

        $this->assertInternalType("object", $ratings);
    }

    public function testRelated()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->movies->related($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testStats()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $stats = $trakt->movies->stats($this->id);

        $this->assertInternalType("object", $stats);
    }

    public function testSummary()
    {
        $client = mock_client(200, movieJson());
        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->movies->summary(get_token(), $this->id);
        $this->assertInstanceOf(Movie::class, $res);
    }

    public function testTranslations()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->movies->translations($this->id, "NL");

        $this->assertInternalType("object", $res);
    }

    public function testTrending()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->movies->trending(get_token());

        $this->assertInternalType("object", $res);
    }

    public function testWatching()
    {
        $client = mock_client(200, "[]");

        $auth = mock_auth();

        $trakt = new Trakt($auth, $client);

        $res = $trakt->movies->watching($this->id);

        $this->assertInternalType("object", $res);
    }
}
