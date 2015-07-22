<?php
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\CheckIn\Create;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\RequestType;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 19:26
 */
class MovieCheckInTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testStaticCall()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);

        $request = new Create(get_token(), movie($client), "Awesome Movie!", [], null, null, null, null);

        $url = $request->getUrl();

        $type = $request->getRequestType();

        $this->assertEquals(RequestType::POST, $type);
        $this->assertEquals("checkin", $url);
    }
}
