<?php
use GuzzleHttp\Client;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Contracts\ExecutesRequest;
use Wubs\Trakt\Auth\TraktProvider;
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
        $provider = new TraktProvider(getenv("TRAKT_CLIENT_ID"), getenv("TRAKT_CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $auth = new Auth($provider);

        $this->trakt = new Trakt($auth, TraktHttpClient::make());

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
        $provider->shouldReceive("getClientId")->once()->andReturn(get_client_id());
        $auth = new Auth($provider);

        $trakt = new Trakt($auth, TraktHttpClient::make());

        $trakt->auth->authorize(getenv("TRAKT_CLIENT_ID"), getenv("TRAKT_CLIENT_SECRET"), "uri");
    }
}
