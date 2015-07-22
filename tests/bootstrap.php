<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 16:41
 */

use Dotenv\Dotenv;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Token\TraktAccessToken;

require __DIR__ . "/../vendor/autoload.php";

(new Dotenv(dirname(__DIR__)))->load();

/**
 * @return \League\OAuth2\Client\Token\AccessToken
 */
function get_token()
{
    return TraktAccessToken::create(
        getenv("TRAKT_ACCESS_TOKEN"),
        getenv("TRAKT_TOKEN_TYPE"),
        getenv("TRAKT_EXPIRES_IN"),
        getenv("TRAKT_REFRESH_TOKEN"),
        getenv("TRAKT_SCOPE")
    );
}

function get_client_id()
{
    return getenv("CLIENT_ID");
}

/**
 * A helper function to get a movie object
 *
 * @param ClientInterface $client
 * @return Movie
 */
function movie(ClientInterface $client)
{
    return new Movie(json_decode(movieJson()), get_client_id(), get_token(), $client);
}

function movieJson()
{
    return '{
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
}

function episode(ClientInterface $client)
{
    return new Episode(json_decode(episodeJson()), get_client_id(), get_token(), $client);
}

function episodeJson()
{
    return '{
    "type": "episode",
    "score": 42.50835,
    "episode": {
      "season": 1,
      "number": 5,
      "title": "Gray Matter",
      "overview": "Walter and Skyler attend a former colleagus party",
      "images": {
        "screenshot": {
          "full": "https://walter.trakt.us/images/episodes/000/000/062/screenshots/original/dbb0a11808.jpg?1412374314",
          "medium": "https://walter.trakt.us/images/episodes/000/000/062/screenshots/medium/dbb0a11808.jpg?1412374314",
          "thumb": "https://walter.trakt.us/images/episodes/000/000/062/screenshots/thumb/dbb0a11808.jpg?1412374314"
        }
},
"ids": {
    "trakt": 20,
        "tvdb": 349238,
        "imdb": "tt1054727",
        "tmdb": 62089,
        "tvrage": 637646
      }
    },
    "show": {
    "title": "Breaking Bad",
      "year": 2008,
      "ids": {
        "trakt": 1
      }
    }
  }';
}

/**
 * @param integer $statusCode
 * @param string $requestResponse
 * @return \Mockery\MockInterface
 */
function mock_client($statusCode, $requestResponse = '[]')
{
    $client = Mockery::mock(ClientInterface::class);
    $request = Mockery::mock(RequestInterface::class);
    $response = Mockery::mock(ResponseInterface::class);

    $client->shouldReceive("createRequest")->once()->andReturn($request);
    $client->shouldReceive("send")->once()->andReturn($response);
    $response->shouldReceive("getStatusCode")->once()->andReturn($statusCode);
    $response->shouldReceive("json")->once()->andReturn(json_decode($requestResponse));

    return $client;
}