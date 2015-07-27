<?php


use Wubs\Trakt\Api\Calendars;
use Wubs\Trakt\Api\Users;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Trakt;
use Wubs\Trakt\TraktHttpClient;

class ExtendedInfoTest extends PHPUnit_Framework_TestCase
{

    public function testCanSetExtendedLevelOnEndpoint()
    {
        $endpoint = new Calendars\My(get_client_id(), TraktHttpClient::make());

        $endpoint->withImages()->withFull();
        $calendar = $endpoint->shows(get_token());

        $first = $calendar->first();

        $this->assertObjectHasAttribute("images", $first->episode);
    }

    public function testCanSetExtendedInfoToImages()
    {
        $trakt = new Trakt(new Auth(new TraktProvider(get_client_id(), get_client_secret(), get_redirect_url())));
        $history = $trakt->users->withImages()->history("megawubs");

        $first = $history->first();
        $this->assertObjectHasAttribute("images", $first->show);
    }
}
