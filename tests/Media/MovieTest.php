<?php
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\Parameters\Query;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 11:40
 */
class MovieTest extends PHPUnit_Framework_TestCase
{

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
        $mockResponse = new MockResponse($json);

        $movie = new Movie($mockResponse->json(['object' => true]), $clientId, $token);

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
        $mockResponse = new MockResponse($json);
        $json = $mockResponse->json(["object" => true]);

        $movie = new Movie($json, get_client_id(), get_token());

        $this->assertEquals("The Dark Knight", $movie->title);
    }
}
