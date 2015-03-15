<?php
use Wubs\Trakt\Request\Users\Settings;
use Wubs\Trakt\Trakt;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 14:18
 */
class SettingsTest extends PHPUnit_Framework_TestCase
{

    public function testInitiation()
    {
        $settingsRequest = new Settings();

        $settingsRequest->setClientId(get_client_id());

        $settingsRequest->setToken(get_token());

        $this->assertInstanceOf("Wubs\\Trakt\\Request\\Users\\Settings", $settingsRequest);
    }

    public function testCanCallRequest()
    {
        $request = new Settings([]);
        $request->setToken(get_token());

        $trakt = new Trakt(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

        $trakt->call($request);
    }
}
