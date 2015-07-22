<?php


use Carbon\Carbon;
use Wubs\Trakt\Api;
use Wubs\Trakt\Auth;
use Wubs\Trakt\Trakt;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;

class ShowsRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Api
     */
    protected $trakt;

    protected $id = "orphan-black";

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testAliases()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $aliases = $trakt->shows->aliases($this->id);

        $this->assertInternalType("object", $aliases);
    }

    public function testComments()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $comments = $trakt->shows->comments($this->id, get_token());

        $this->assertInternalType("object", $comments);
    }

    public function testPeople()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $people = $trakt->shows->people($this->id);

        $this->assertInternalType("object", $people);
    }

    public function testPopular()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $popular = $trakt->shows->popular();

        $this->assertInternalType("object", $popular);
    }

    public function testRatings()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $ratings = $trakt->shows->ratings($this->id);

        $this->assertInternalType("object", $ratings);
    }

    public function testRelated()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->related($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testStats()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $stats = $trakt->shows->stats($this->id);

        $this->assertInternalType("object", $stats);
    }

    public function testSummary()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->summary($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testTranslations()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->translations($this->id, "NL");

        $this->assertInternalType("object", $res);
    }

    public function testTrending()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->trending();

        $this->assertInternalType("object", $res);
    }

    public function testUpdates()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->updates(Carbon::now());

        $this->assertInternalType("object", $res);
    }

    public function testWatching()
    {
        $client = mock_client(200, "[]");

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->watching($this->id);

        $this->assertInternalType("object", $res);
    }
}
