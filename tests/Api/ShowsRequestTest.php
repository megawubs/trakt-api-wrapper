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

    public function tearDown()
    {
        Mockery::close();
    }

    public function testAliases()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $aliases = $trakt->shows->aliases($this->id);

        $this->assertInternalType("array", $aliases);
    }

    public function testComments()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $comments = $trakt->shows->comments($this->id, get_token());

        $this->assertInternalType("array", $comments);
    }

    public function testPeople()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $people = $trakt->shows->people($this->id);

        $this->assertInternalType("array", $people);
    }

    public function testPopular()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $popular = $trakt->shows->popular();

        $this->assertInternalType("array", $popular);
    }

    public function testRatings()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $ratings = $trakt->shows->ratings($this->id);

        $this->assertInternalType("array", $ratings);
    }

    public function testRelated()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->related($this->id);

        $this->assertInternalType("array", $res);
    }

    public function testStats()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $stats = $trakt->shows->stats($this->id);

        $this->assertInternalType("array", $stats);
    }

    public function testSummary()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->summary($this->id);

        $this->assertInternalType("array", $res);
    }

    public function testTranslations()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->translations($this->id, "NL");

        $this->assertInternalType("array", $res);
    }

    public function testTrending()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->trending();

        $this->assertInternalType("array", $res);
    }

    public function testUpdates()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->updates(Carbon::now());

        $this->assertInternalType("array", $res);
    }

    public function testWatching()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn([]);
        $client->shouldReceive("send")->andReturn($response);

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(getenv("CLIENT_ID"), $client, $auth);

        $res = $trakt->shows->watching($this->id);

        $this->assertInternalType("array", $res);
    }
}
