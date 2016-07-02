<?php


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Trakt;

class CheckOutRequestTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testCheckOutFromGlobal()
    {
        $client = Mockery::mock(ClientInterface::class);
        $request = Mockery::mock(RequestInterface::class);
        $response = Mockery::mock(ResponseInterface::class);

        $client->shouldReceive("createRequest")->andReturn($request);
        $client->shouldReceive("send")->once()->andReturn($response);
        $response->shouldReceive("getStatusCode")->twice()->andReturn(204);

        $trakt = new Trakt(mock_auth(), $client);

        $this->assertTrue($trakt->checkIn->delete(get_token()));
    }
}
