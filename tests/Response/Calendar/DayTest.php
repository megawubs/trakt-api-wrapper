<?php
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Response\Calendar\Day;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 17:29
 */
class DayTest extends PHPUnit_Framework_TestCase
{

    public function testHasReleasesOfTheDayAsMediaObject()
    {
        $json = '{
          "2014-08-01": [
            {
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
            },
             {
              "movie": {
                "title": "Get On Up",
                "year": 2014,
                "ids": {
                  "trakt": 29,
                  "slug": "get-on-up-2014",
                  "imdb": "tt2473602",
                  "tmdb": 239566
                }
              }
            }
        ]}';
        $response = new MockResponse($json);
        $json = $response->json(["object" => true]);

        foreach ($json as $date => $movies) {
            $day = new Day($date, $movies, Type::movie(), get_client_id(), get_token());
        }

        $this->assertInstanceOf(Media::class, $day->releases[0]);
        $this->assertCount(2, $day->releases);
    }

    public function testParseMultipleReleaseDates()
    {
        $json = '{
              "2014-08-01": [
                {
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
                },
                {
                  "movie": {
                    "title": "Get On Up",
                    "year": 2014,
                    "ids": {
                      "trakt": 29,
                      "slug": "get-on-up-2014",
                      "imdb": "tt2473602",
                      "tmdb": 239566
                    }
                  }
                }
              ],
              "2014-08-08": [
                {
                  "movie": {
                    "title": "Teenage Mutant Ninja Turtles",
                    "year": 2014,
                    "ids": {
                      "trakt": 30,
                      "slug": "teenage-mutant-ninja-turtles-2014",
                      "imdb": "tt1291150",
                      "tmdb": 98566
                    }
                  }
                }
              ]
            }';

        $response = new MockResponse($json);
        $json = $response->json(["object" => true]);

        $days = [];

        foreach ($json as $date => $movies) {
            $days[] = new Day($date, $movies, Type::movie(), get_client_id(), get_token());
        }

        $this->assertInstanceOf(Day::class, $days[0]);
        $this->assertCount(2, $days);
        $this->assertInstanceOf(Media::class, $days[0]->releases[0]);
    }

    public function testCanHandleResponseWithShows()
    {
        $json = '{
  "2014-07-14": [
    {
      "airs_at": "2014-07-14T01:00:00.000Z",
      "episode": {
        "season": 7,
        "number": 4,
        "title": "Death is Not the End",
        "ids": {
          "trakt": 443,
          "tvdb": 4851180,
          "imdb": "tt3500614",
          "tmdb": 988123,
          "tvrage": null
        }
      },
      "show": {
        "title": "True Blood",
        "year": 2008,
        "ids": {
          "trakt": 5,
          "slug": "true-blood",
          "tvdb": 82283,
          "imdb": "tt0844441",
          "tmdb": 10545,
          "tvrage": 12662
        }
      }
    },
    {
      "airs_at": "2014-07-14T02:00:00.000Z",
      "episode": {
        "season": 1,
        "number": 3,
        "title": "Two Boats and a Helicopter",
        "ids": {
          "trakt": 499,
          "tvdb": 4854797,
          "imdb": "tt3631218",
          "tmdb": 988346,
          "tvrage": null
        }
      },
      "show": {
        "title": "The Leftovers",
        "year": 2014,
        "ids": {
          "trakt": 7,
          "slug": "the-leftovers",
          "tvdb": 269689,
          "imdb": "tt2699128",
          "tmdb": 54344,
          "tvrage": null
        }
      }
    }
  ],
  "2014-07-21": [
    {
      "airs_at": "2014-07-21T01:00:00.000Z",
      "episode": {
        "season": 7,
        "number": 5,
        "title": "Return to Oz",
        "ids": {
          "trakt": 444,
          "tvdb": 4851181,
          "imdb": "tt3500616",
          "tmdb": 988124,
          "tvrage": null
        }
      },
      "show": {
        "title": "True Blood",
        "year": 2008,
        "ids": {
          "trakt": 5,
          "slug": "true-blood",
          "tvdb": 82283,
          "imdb": "tt0844441",
          "tmdb": 10545,
          "tvrage": 12662
        }
      }
    },
    {
      "airs_at": "2014-07-21T02:00:00.000Z",
      "episode": {
        "season": 1,
        "number": 4,
        "title": "B.J. and the A.C.",
        "ids": {
          "trakt": 500,
          "tvdb": 4854798,
          "imdb": "tt3594942",
          "tmdb": 988347,
          "tvrage": null
        }
      },
      "show": {
        "title": "The Leftovers",
        "year": 2014,
        "ids": {
          "trakt": 7,
          "slug": "the-leftovers",
          "tvdb": 269689,
          "imdb": "tt2699128",
          "tmdb": 54344,
          "tvrage": null
        }
      }
    }
  ]
}';
        $mockResponse = new MockResponse($json);

        $json = $mockResponse->json(['object' => true]);

        $days = [];
        foreach ($json as $date => $shows) {
            $days[] = new Day($date, $shows, Type::show(), get_client_id(), get_token());
        }

        $this->assertInstanceOf(Show::class, $days[0]->releases[0]);
        $this->assertCount(2, $days);
    }
}
