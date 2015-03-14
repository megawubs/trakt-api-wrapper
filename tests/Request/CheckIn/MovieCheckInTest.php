<?php
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\CheckIn\MovieCheckIn;
use Wubs\Trakt\Request\Parameters\Query;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 19:26
 */
class MovieCheckInTest extends PHPUnit_Framework_TestCase
{
    public function testStaticCall()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $movie = Movie::search($id, $token, Query::set("guardians of the galaxy"));

        $response = MovieCheckIn::request($id, $token, $movie[1]);

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\CheckIn", $response);

    }
}
