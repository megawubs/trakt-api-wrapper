<?php
use Wubs\Trakt\Response\Calendar\Calendar;
use Wubs\Trakt\Response\Calendar\Day;
use Wubs\Trakt\Response\Handlers\Calendars\MoviesHandler;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 17:05
 */
class MoviesHandlerTest extends PHPUnit_Framework_TestCase
{

    public function testParsesResponseToListOfMovies()
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

        $mockResponse = new MockResponse($json);
        $moviesHandler = new MoviesHandler();

        $moviesHandler->setId(get_client_id());
        $moviesHandler->setToken(get_token());

        $handled = $moviesHandler->handle($mockResponse);

        $this->assertInstanceOf(Calendar::class, $handled);
        $this->assertInstanceOf(Day::class, $handled->days[0]);

    }
}
