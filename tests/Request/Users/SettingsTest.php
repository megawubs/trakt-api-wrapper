<?php
use Wubs\Trakt\Request\RequestType;
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

        $this->assertEquals(RequestType::GET, $settingsRequest->getRequestType());
        $this->assertEquals("users/settings", $settingsRequest->getUrl());
    }
}
