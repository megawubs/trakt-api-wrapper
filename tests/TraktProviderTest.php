<?php
use Wubs\Trakt\Auth\TraktProvider;

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
        $clientId = getenv("TRAKT_CLIENT_ID");
        $provider = new TraktProvider($clientId, getenv("TRAKT_CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

        $this->assertInstanceOf(TraktProvider::class, $provider);
    }

    public function testAuthUrlHasClientId()
    {
        $clientId = getenv("TRAKT_CLIENT_ID");
        $provider = new TraktProvider($clientId, getenv("TRAKT_CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

        $authUrl = $provider->getAuthorizationUrl();

        $this->assertContains(getenv("TRAKT_CLIENT_ID"), $authUrl);

    }

    public function testGetTraktAuthorizationUrl()
    {
        $clientId = get_client_id();
        $provider = new TraktProvider($clientId, getenv("TRAKT_CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $authUrl = $provider->getAuthorizationUrl();

        $this->assertContains("https://trakt.tv/oauth/authorize", $authUrl);
        $this->assertContains(get_client_id(), $authUrl);
    }
}
