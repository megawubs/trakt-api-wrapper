<?php
use Wubs\Trakt\Contracts\ExecutesRequest;
use Wubs\Trakt\Request\DescribesRequest;
use Wubs\Trakt\Trakt;

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
        $trakt = Trakt::api(getenv("CLIENT_ID"));

        $response = $trakt->movies->popular();

        $this->assertInternalType("array", $response);
    }

    public function testOAuthFlowAuthorization()
    {
        $auth = Trakt::auth(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), "uri");

        $auth->authorize();
    }

    public function testOAuthFlowAccessToken()
    {
        $code = "blaat";

        $auth = Trakt::auth(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), "uri");

        $auth->getToken(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), $code);
    }
}
