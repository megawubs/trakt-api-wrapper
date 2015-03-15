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

    public function testCanFindMovieOnSlug()
    {
        $movies = Movie::search(get_client_id(), get_token(), Query::set("guardians of the galaxy"));

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Movie", $movies[0]);
    }
}
