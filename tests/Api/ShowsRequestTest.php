<?php


use Carbon\Carbon;
use Wubs\Trakt\Api;
use Wubs\Trakt\Auth\Auth;
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
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $aliases = $trakt->shows->aliases($this->id);

        $this->assertInternalType("object", $aliases);
    }

    public function testComments()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $comments = $trakt->shows->comments($this->id, get_token());

        $this->assertInternalType("object", $comments);
    }

    public function testPeople()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $people = $trakt->shows->people($this->id);

        $this->assertInternalType("object", $people);
    }

    public function testPopular()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $popular = $trakt->shows->popular();

        $this->assertInternalType("object", $popular);
    }

    public function testRatings()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $ratings = $trakt->shows->ratings($this->id);

        $this->assertInternalType("object", $ratings);
    }

    public function testRelated()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->shows->related($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testStats()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $stats = $trakt->shows->stats($this->id);

        $this->assertInternalType("object", $stats);
    }

    public function testSummary()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->shows->summary($this->id);

        $this->assertInternalType("object", $res);
    }

    public function testTranslations()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->shows->translations($this->id, "NL");

        $this->assertInternalType("object", $res);
    }

    public function testTrending()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->shows->trending();

        $this->assertInternalType("object", $res);
    }

    public function testUpdates()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->shows->updates(Carbon::now());

        $this->assertInternalType("object", $res);
    }

    public function testWatching()
    {
        $trakt = new Trakt(mock_auth(), mock_client(200, "[]"));

        $res = $trakt->shows->watching($this->id);

        $this->assertInternalType("object", $res);
    }
}
