<?php


use Wubs\Trakt\Api\Users\Follow;
use Wubs\Trakt\Api\Users\Followers;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Trakt;

class PropertiesTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testPropertiesOfRequestObjectAreRequestObjects()
    {
        $auth = new Auth(new TraktProvider(get_client_id(), get_client_secret(), get_redirect_url()));

        $trakt = new Trakt($auth);

        $this->assertInstanceOf(Followers::class, $trakt->users->followers);
    }
}
