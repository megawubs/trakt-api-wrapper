<?php
use GuzzleHttp\Client;
use Wubs\Trakt\Auth;
use Wubs\Trakt\Contracts\ExecutesRequest;
use Wubs\Trakt\Provider\TraktProvider;
use Wubs\Trakt\Request\DescribesRequest;
use Wubs\Trakt\Trakt;
use Wubs\Trakt\TraktHttpClient;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 02/04/15
 * Time: 18:45
 */
class HowItShouldWorkTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Trakt
     */
    private $trakt;

    protected function tearDown()
    {
        Mockery::close();
    }

    protected function setUp()
    {
        $provider = new TraktProvider(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $auth = new Auth($provider);

        $this->trakt = new Trakt(getenv("CLIENT_ID"), TraktHttpClient::make(), $auth);

    }

    /**
     * @expectedException Wubs\Trakt\Request\Exception\HttpCodeException\MethodNotFoundException;
     */
    public function testPublicApi()
    {

        $popular = $this->trakt->movies->popular();
        $this->assertInternalType("object", $popular);

    }

    public function testOAuthFlowAuthorization()
    {
        $provider = Mockery::mock(TraktProvider::class);
        $provider->shouldReceive("authorize")->once();
        $auth = new Auth($provider);

        $trakt = new Trakt(getenv("CLIENT_ID"), TraktHttpClient::make(), $auth);

        $trakt->auth->authorize(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), "uri");
    }
}
