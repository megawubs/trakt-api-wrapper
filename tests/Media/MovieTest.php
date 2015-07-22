<?php
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Trakt;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 11:40
 */
class MovieTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testCanMakeMovieObjectFromSearchResult()
    {
        $json = '{
    "type": "movie",
    "score": 26.019499,
    "movie": {
      "title": "Batman Begins",
      "overview": "Driven by tragedy, billionaire Bruce Wayne dedicates his life to uncovering and defeating the corruption that plagues his home, Gotham City.  Unable to work within the system, he instead creates a new identity, a symbol of fear for the criminal underworld - The Batman.",
      "year": 2005,
      "images": {
        "poster": {
          "full": "https://walter.trakt.us/images/movies/000/000/001/posters/original/9634ffd477.jpg?1406080393",
          "medium": "https://walter.trakt.us/images/movies/000/000/001/posters/medium/9634ffd477.jpg?1406080393",
          "thumb": "https://walter.trakt.us/images/movies/000/000/001/posters/thumb/9634ffd477.jpg?1406080393"
        },
        "fanart": {
          "full": "https://walter.trakt.us/images/movies/000/000/001/fanarts/original/7da8cfbe9e.jpg?1406080393",
          "medium": "https://walter.trakt.us/images/movies/000/000/001/fanarts/medium/7da8cfbe9e.jpg?1406080393",
          "thumb": "https://walter.trakt.us/images/movies/000/000/001/fanarts/thumb/7da8cfbe9e.jpg?1406080393"
        }
      },
      "ids": {
        "trakt": 1,
        "slug": "batman-begins-2005",
        "imdb": "tt0372784",
        "tmdb": 272
      }
    }
  }';
        $clientId = get_client_id();
        $token = get_token();
        $mockResponse = new TestResponse($json);
        $client = Mockery::mock(ClientInterface::class);
        $movie = new Movie($mockResponse->json(['object' => true]), $clientId, $token, $client);

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Movie", $movie);
        $this->assertEquals(26.019499, $movie->score);
        $this->assertEquals("Batman Begins", $movie->title);
    }

    public function testCanMakeMovieObjectFromBasicResult()
    {
        $json = '{
    "title": "The Dark Knight",
    "year": 2008,
    "ids": {
      "trakt": 16,
      "slug": "the-dark-knight-2008",
      "imdb": "tt0468569",
      "tmdb": 155
    }
  }';
        $json = json_decode($json);

        $client = Mockery::mock(ClientInterface::class);
        $movie = new Movie($json, get_client_id(), get_token(), $client);

        $this->assertEquals("The Dark Knight", $movie->title);
    }

    public function testCanCheckInFromMovieObject()
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

        $movie = movie($client);

        $checkin = $movie->checkIn([], "Never seen this one before!");

        $this->assertInstanceOf("Wubs\\Trakt\\Response\\CheckIn", $checkin);

        $this->assertTrue($checkin->isSharedOnFacebook());
        $this->assertEquals("Guardians of the Galaxy", $checkin->media->title);
    }

}
