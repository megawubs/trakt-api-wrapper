<?php
use GuzzleHttp\Client;
use Wubs\Trakt\Auth;
use Wubs\Trakt\Provider\TraktProvider;
use Wubs\Trakt\Trakt;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 13:44
 */
class TraktTest extends PHPUnit_Framework_TestCase
{
    public function testCanInitiateTrakt()
    {
        $provider = new TraktProvider(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $auth = new Auth($provider);

        $trakt = new Trakt(getenv("CLIENT_ID"), new Client(), $auth);

        $this->assertInstanceOf("Wubs\\Trakt\\Trakt", $trakt);
    }

    public function testInvalidAuthorization()
    {
        $provider = new TraktProvider(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $auth = new Auth($provider);

        $trakt = new Trakt(getenv("CLIENT_ID"), new Client(), $auth);
        $_SESSION['trakt_oauth_state'] = "ADifferentState";
        $_GET['state'] = 'NotTheStateItShouldBe';

        $test = $trakt->auth->isValid();

        $this->assertFalse($test);
    }

    public function testValidAuthorization()
    {
        $provider = new TraktProvider(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $auth = new Auth($provider);

        $trakt = new Trakt(getenv("CLIENT_ID"), new Client(), $auth);

        $_SESSION['trakt_oauth_state'] = "AState";
        $_GET['state'] = 'AState';

        $test = $trakt->auth->isValid();

        $this->assertTrue($test);

    }
}
