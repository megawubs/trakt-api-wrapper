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
    public function testCanInitiateTrakt()
    {
        $trakt = new Trakt(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

        $this->assertInstanceOf("Wubs\\Trakt\\Trakt", $trakt);
    }

//    public function testAuthorisation()
//    {
//        $trakt = new Trakt(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
//
//        $trakt->authorize();
//    }
}
