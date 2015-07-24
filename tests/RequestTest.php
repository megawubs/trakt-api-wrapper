<?php
use Carbon\Carbon;
use GuzzleHttp\ClientInterface;
use Wubs\Trakt\Request\Calendars\My\Movies;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Username;
use Wubs\Trakt\Request\Users\History;
use Wubs\Trakt\TraktHttpClient;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/03/15
 * Time: 19:35
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    public function testCanMakeRequest()
    {
        $result = (new Movies(get_token(), Carbon::today(), 7))->make(
            get_client_id(),
            TraktHttpClient::make()
        );

        $this->assertInternalType("object", $result);
    }

    public function testRequestWithoutToken()
    {
        $response = (new History('megawubs', Type::movies()))->make(get_client_id(), TraktHttpClient::make());

        $this->assertInternalType("object", $response);

    }


}
