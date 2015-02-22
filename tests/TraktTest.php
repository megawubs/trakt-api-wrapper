<?php
use GuzzleHttp\Message\Request;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Contracts\RequestInterface;
use Wubs\Trakt\Trakt;
use Wubs\Trakt\TraktProvider;
use Wubs\Trakt\TraktToken;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 13:44
 */
class TraktTest extends PHPUnit_Framework_TestCase
{
    private static $token;

    public static function setUpBeforeClass()
    {
        static::$token = get_token();
    }

    public function testCanInitiateTrakt()
    {
        $mockRequest = new MockRequest();
        $trakt = new Trakt(static::$token, $mockRequest);

        $this->assertInstanceOf("Wubs\\Trakt\\Trakt", $trakt);
    }

    public function testCanGetUserSettings()
    {
        $request = new \Wubs\Trakt\Request();
        $trakt = new Trakt(static::$token, $request);

        $response = $trakt->settings();

        $this->assertInternalType("array", $response);
    }

    public function testCanPreformGetRequest()
    {
        $request = new \Wubs\Trakt\Request();
        $trakt = new Trakt(static::$token, $request);

        $result = $trakt->get("movies/popular");

        $this->assertInternalType("array", $result);
    }
}

class MockRequest implements RequestInterface
{
    public function create($method, $path, TraktToken $token, $options = [])
    {

    }

    public function send()
    {
//        return [];
    }

    public function getRequest()
    {

    }
}
