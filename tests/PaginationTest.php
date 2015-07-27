<?php


use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Trakt;

class PaginationTest extends PHPUnit_Framework_TestCase
{


    public function testCanPaginate()
    {
        $trakt = new Trakt(new Auth(new TraktProvider(get_client_id(), get_client_secret(), get_redirect_url())));

        $trakt->users->page(2)->history("megawubs");
    }
}
