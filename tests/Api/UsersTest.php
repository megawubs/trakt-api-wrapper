<?php


use Illuminate\Support\Collection;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Trakt;

class UsersTest extends PHPUnit_Framework_TestCase
{

    public function testCanGetWathchlist()
    {
        $trakt = new Trakt(new Auth(new TraktProvider(get_client_id(), get_client_secret(), get_redirect_url())));

        $watchlist = $trakt->users->watchlist("megawubs");

        $this->assertInstanceOf(Collection::class, $watchlist);
    }
}
