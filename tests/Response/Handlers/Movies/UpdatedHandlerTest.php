<?php

use Wubs\Trakt\ClientId;
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
        $response = new MockResponse($json);

        $handler = new UpdatedHandler();

        $handler->setId(ClientId::set(getenv("CLIENT_ID")));
        $handler->setToken(get_token());

        $updates = $handler->handle($response);

        $this->assertInstanceOf(Updated::class, $updates[0]);
    }
}
