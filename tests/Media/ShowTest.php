<?php
use GuzzleHttp\ClientInterface;
use Wubs\Trakt\Media\Show;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 19:36
 */
class ShowTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }

    public function testCanProcessSearchResult()
    {
        $json = '{
  "type": "show",
  "score": 19.533358,
  "show": {
    "title": "Breaking Bad",
    "overview": "Breaking Bad is an American crime drama television series created and produced by Vince Gilligan. Set and produced in Albuquerque, New Mexico, Breaking Bad is the story of Walter White, a struggling high school chemistry teacher who is diagnosed with inoperable lung cancer at the beginning of the series. He turns to a life of crime, producing and selling methamphetamine, in order to secure his family financial future before he dies, teaming with his former student, Jesse Pinkman. Heavily serialized, the series is known for positioning its characters in seemingly inextricable corners and has been labeled a contemporary western by its creator.",
    "year": 2008,
    "images": {
      "poster": {
        "full": "https://walter.trakt.us/images/shows/000/000/001/posters/original/7217fe0ea7.jpg?1412271410",
        "medium": "https://walter.trakt.us/images/shows/000/000/001/posters/medium/7217fe0ea7.jpg?1412271410",
        "thumb": "https://walter.trakt.us/images/shows/000/000/001/posters/thumb/7217fe0ea7.jpg?1412271410"
      },
      "fanart": {
        "full": "https://walter.trakt.us/images/shows/000/000/001/fanarts/original/2fb47044fd.jpg?1412271412",
        "medium": "https://walter.trakt.us/images/shows/000/000/001/fanarts/medium/2fb47044fd.jpg?1412271412",
        "thumb": "https://walter.trakt.us/images/shows/000/000/001/fanarts/thumb/2fb47044fd.jpg?1412271412"
      }
    },
    "ids": {
      "trakt": 1,
      "slug": "breaking-bad",
      "tvdb": 81189,
      "imdb": "tt0903747",
      "tmdb": 1396,
      "tvrage": 18164
    }
  }
}';

        $json = json_decode($json);
        $client = Mockery::mock(ClientInterface::class);
        $show = new Show($json, get_client_id(), get_token(), $client);

        $this->assertEquals("Breaking Bad", $show->title);

    }
}
