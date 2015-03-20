<?php
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Provider\TraktProvider;

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
        $clientId = ClientId::set(getenv("CLIENT_ID"));
        $provider = new TraktProvider($clientId, getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

        $this->assertInstanceOf('Wubs\\Trakt\\Provider\\TraktProvider', $provider);
    }

    public function testAuthUrlHasClientId()
    {
        $clientId = ClientId::set(getenv("CLIENT_ID"));
        $provider = new TraktProvider($clientId, getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

        $authUrl = $provider->getAuthorizationUrl();

        $this->assertContains(getenv("CLIENT_ID"), $authUrl);

    }

    public function testGetTraktAuthorizationUrl()
    {
        $clientId = ClientId::set(getenv("CLIENT_ID"));
        $provider = new TraktProvider($clientId, getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
        $authUrl = $provider->getAuthorizationUrl();

        $this->assertContains("https://trakt.tv/oauth/authorize", $authUrl);
        $this->assertContains(getenv('CLIENT_ID'), $authUrl);
    }
}
