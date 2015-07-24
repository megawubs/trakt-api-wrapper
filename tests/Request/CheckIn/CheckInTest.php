<?php

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\CheckIn\Delete;
use Wubs\Trakt\Request\CheckIn\Create;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\Search\ByText;
use Wubs\Trakt\Response\CheckIn;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 15:52
 */
class CheckInTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testCheckIn()
    {

        /** @var Movie $movie */
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn(
            json_decode(
                '{
  "watched_at": "2014-08-06T01:11:37.953Z",
  "sharing": {
    "facebook": true,
    "twitter": true,
    "tumblr": false
  },
  "movie": {
    "title": "Guardians of the Galaxy",
    "year": 2014,
    "ids": {
      "trakt": 28,
      "slug": "guardians-of-the-galaxy-2014",
      "imdb": "tt2015381",
      "tmdb": 118340
    }
  }
}'
            )
        );
        $client->shouldReceive("send")->andReturn($response);

        $movie = movie($client);

        $response = $movie->checkIn([], "I like this one!", null, null, null, null);
//
        $this->assertInstanceOf(CheckIn::class, $response);
    }

    public function testCheckOut()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

        $client->shouldReceive("createRequest")->once()->andReturn($request);
        $response->shouldReceive("getStatusCode")->twice()->andReturn(204);

        $client->shouldReceive("send")->andReturn($response);

        $id = get_client_id();
        $token = get_token();

        $response = (new Delete($token))->make($id, $client);

        $this->assertTrue($response);
    }

}
