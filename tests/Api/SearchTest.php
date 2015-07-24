<?php


use Illuminate\Support\Collection;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Trakt;

class SearchTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        Mockery::close();
    }

    public function testSearchMovieWithoutToken()
    {
        $client = mock_client(
            200,
            '[
  {
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
  }
]'
        );
        $auth = mock_auth();
        $trakt = new Trakt($auth, $client);

        $result = $trakt->search->byText("Batman Begins", Type::show(), 2011);

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertInternalType("object", $result[0]);

    }

    public function testSearchMovieWithToken()
    {
        $client = mock_client(
            200,
            '[
  {
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
  }
]'
        );

        $auth = mock_auth();
        $trakt = new Trakt($auth, $client);
        $search = $trakt->search->byText("Batman", Type::movie(), 2011, get_token());

        $this->assertInstanceOf(Collection::class, $search);
        $this->assertInstanceOf(Movie::class, $search->first());
    }

    public function testSearchMovieById()
    {
        $client = mock_client(
            200,
            '[
  {
    "type": "movie",
    "score": null,
    "movie": {
      "title": "The Avengers",
      "overview": "When an unexpected enemy emerges and threatens global safety and security, Nick Fury, director of the international peacekeeping agency known as S.H.I.E.L.D., finds himself in need of a team to pull the world back from the brink of disaster. Spanning the globe, a daring recruitment effort begins!",
      "year": 2012,
      "images": {
        "poster": {
          "full": "https://walter.trakt.us/images/movies/000/000/012/posters/original/293ce7103a.jpg?1406080484",
          "medium": "https://walter.trakt.us/images/movies/000/000/012/posters/medium/293ce7103a.jpg?1406080484",
          "thumb": "https://walter.trakt.us/images/movies/000/000/012/posters/thumb/293ce7103a.jpg?1406080484"
        },
        "fanart": {
          "full": "https://walter.trakt.us/images/movies/000/000/012/fanarts/original/7d93500475.jpg?1406080485",
          "medium": "https://walter.trakt.us/images/movies/000/000/012/fanarts/medium/7d93500475.jpg?1406080485",
          "thumb": "https://walter.trakt.us/images/movies/000/000/012/fanarts/thumb/7d93500475.jpg?1406080485"
        }
      },
      "ids": {
        "trakt": 12,
        "slug": "the-avengers-2012",
        "imdb": "tt0848228",
        "tmdb": 24428
      }
    }
  }
]'
        );

        $auth = mock_auth();
        $trakt = new Trakt($auth, $client);

        $result = $trakt->search->byId('trakt-movie', 12);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertInternalType("object", $result->first());

    }

    public function testSearchMovieByIdWithAuthToken()
    {
        $client = mock_client(
            200,
            '[
  {
    "type": "movie",
    "score": null,
    "movie": {
      "title": "The Avengers",
      "overview": "When an unexpected enemy emerges and threatens global safety and security, Nick Fury, director of the international peacekeeping agency known as S.H.I.E.L.D., finds himself in need of a team to pull the world back from the brink of disaster. Spanning the globe, a daring recruitment effort begins!",
      "year": 2012,
      "images": {
        "poster": {
          "full": "https://walter.trakt.us/images/movies/000/000/012/posters/original/293ce7103a.jpg?1406080484",
          "medium": "https://walter.trakt.us/images/movies/000/000/012/posters/medium/293ce7103a.jpg?1406080484",
          "thumb": "https://walter.trakt.us/images/movies/000/000/012/posters/thumb/293ce7103a.jpg?1406080484"
        },
        "fanart": {
          "full": "https://walter.trakt.us/images/movies/000/000/012/fanarts/original/7d93500475.jpg?1406080485",
          "medium": "https://walter.trakt.us/images/movies/000/000/012/fanarts/medium/7d93500475.jpg?1406080485",
          "thumb": "https://walter.trakt.us/images/movies/000/000/012/fanarts/thumb/7d93500475.jpg?1406080485"
        }
      },
      "ids": {
        "trakt": 12,
        "slug": "the-avengers-2012",
        "imdb": "tt0848228",
        "tmdb": 24428
      }
    }
  }
]'
        );

        $auth = mock_auth();
        $trakt = new Trakt($auth, $client);

        $result = $trakt->search->byId('trakt-movie', 12, get_token());

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertInternalType("object", $result->first());
        $this->assertInstanceOf(Movie::class, $result->first());

    }
}
