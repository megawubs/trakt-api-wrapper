<?php

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Response\Handlers\Movies\UpdatedHandler;
use Wubs\Trakt\Response\Updated;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 20/03/15
 * Time: 09:57
 */
class UpdatedHandlerTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }


    public function testResponseHandlerConvertsResponseToUpdatedObjects()
    {
        $json = '[
              {
                  "updated_at": "2014-09-22T21:56:03.000Z",
                "movie": {
                  "title": "TRON: Legacy",
                  "year": 2010,
                  "ids": {
                      "trakt": 1,
                    "slug": "tron-legacy-2010",
                    "imdb": "tt1104001",
                    "tmdb": 20526
                  }
                }
              },
              {
                  "updated_at": "2014-09-23T21:56:03.000Z",
                "movie": {
                  "title": "The Dark Knight",
                  "year": 2008,
                  "ids": {
                      "trakt": 4,
                    "slug": "the-dark-knight-2008",
                    "imdb": "tt0468569",
                    "tmdb": 155
                  }
                }
              }
            ]';

        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);

//        $client->shouldReceive("createRequest")->once()->andReturn($request);
//        $response->shouldReceive("getStatusCode")->once()->andReturn(200);
        $response->shouldReceive("json")->once()->andReturn(json_decode($json));
        $client->shouldReceive("send")->andReturn($response);

        $handler = new UpdatedHandler();

        $handler->setClientId(getenv("CLIENT_ID"));
        $handler->setToken(get_token());

        $updates = $handler->handle($response, $client);

        $this->assertInstanceOf(Updated::class, $updates[0]);
    }
}
