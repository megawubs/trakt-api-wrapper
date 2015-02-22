<?php
use Wubs\Trakt\TraktProvider;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 13:13
 */
class TraktProviderTest extends PHPUnit_Framework_TestCase
{
    public function testProviderCanBeInitiated()
    {
        $provider = new TraktProvider();

        $this->assertInstanceOf('Wubs\\Trakt\\TraktProvider', $provider);
    }

    public function testGetTraktAuthorizationUrl()
    {
        $provider = new TraktProvider();
        $authUrl = $provider->getAuthorizationUrl();

        $this->assertContains("https://api-v2launch.trakt.tv/oauth/authorize", $authUrl);
        $this->assertContains(getenv('CLIENT_ID'), $authUrl);
    }
}
