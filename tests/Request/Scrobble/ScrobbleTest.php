<?php

class ScrobbleTest extends PHPUnit_Framework_TestCase
{
    public function testCanStartScrobbling()
    {
        $client = Mockery::mock(\GuzzleHttp\ClientInterface::class);
        $request = new \Wubs\Trakt\Request\Scrobble\Start(get_token(), movie($client), 0);
        $this->assertEquals(\Wubs\Trakt\Request\RequestType::POST, $request->getRequestType());
        $request->make(get_client_id(), \Wubs\Trakt\TraktHttpClient::make(), new \Wubs\Trakt\Response\Handlers\DefaultResponseHandler());
    }

    public function testCanPauseScrobble()
    {
        $client = Mockery::mock(\GuzzleHttp\ClientInterface::class);
        $request = new \Wubs\Trakt\Request\Scrobble\Pause(get_token(), movie($client), 5);
        $this->assertEquals(\Wubs\Trakt\Request\RequestType::POST, $request->getRequestType());
        $request->make(get_client_id(), \Wubs\Trakt\TraktHttpClient::make(), new \Wubs\Trakt\Response\Handlers\DefaultResponseHandler());
    }

    public function testCanStopScrobble()
    {
        $client = Mockery::mock(\GuzzleHttp\ClientInterface::class);
        $request = new \Wubs\Trakt\Request\Scrobble\Stop(get_token(), movie($client), 5);
        $this->assertEquals(\Wubs\Trakt\Request\RequestType::POST, $request->getRequestType());
        $request->make(get_client_id(), \Wubs\Trakt\TraktHttpClient::make(), new \Wubs\Trakt\Response\Handlers\DefaultResponseHandler());
    }
}
