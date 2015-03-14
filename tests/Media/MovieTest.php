<?php
use Wubs\Trakt\Media\Movie;

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
        $movie = Movie::search("guardians-of-the-galaxy-2014");

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Movie", $movie);
    }
}
