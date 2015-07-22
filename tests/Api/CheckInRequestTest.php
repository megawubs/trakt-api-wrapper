<?php


use Wubs\Trakt\Auth;
use Wubs\Trakt\Response\CheckIn;
use Wubs\Trakt\Trakt;

class CheckInRequestTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     *
     */
    public function testCheckInMovie()
    {
        $client = mock_client(
            201,
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
        );

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        $response = $trakt->checkIn->create(get_token(), movie($client), "Such an awesome movie! I love it");

        $this->assertInstanceOf(CheckIn::class, $response);
    }

    public function testCheckInEpisode()
    {
        $client = mock_client(
            201,
            '{
  "episode": {
    "ids": {
      "trakt": 16
    }
  },
  "sharing": {
    "facebook": true,
    "twitter": true,
    "tumblr": false
  },
  "message": "I\'m the one who knocks!",
  "app_version": "1.0",
  "app_date": "2014-09-22"
}'
        );

        $auth = Mockery::mock(Auth::class);

        $trakt = new Trakt(get_client_id(), $client, $auth);

        /** @var CheckIn $response */
        $response = $trakt->checkIn->create(get_token(), episode($client), "Whoooot! I like this so much!");

        $this->assertInstanceOf(CheckIn::class, $response);
        $this->assertInternalType("object", $response->media);
    }
}
