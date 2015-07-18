<?php
use GuzzleHttp\Client;
use Wubs\Trakt\Contracts\ExecutesRequest;
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
     * @expectedException Wubs\Trakt\Request\Exception\HttpCodeException\MethodNotFoundException;
     */
    public function testPublicAPIMovies()
    {
        $trakt = new Trakt(getenv("CLIENT_ID"), TraktHttpClient::make());

        $response = $trakt->movies->popular();

        $this->assertInternalType("array", $response);
    }

    public function testOAuthFlowAuthorization()
    {
        $auth = Trakt::auth(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), "uri");

        $this->assertInstanceOf("Wubs\\Trakt\\Auth", $auth);
    }
}
