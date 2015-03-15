<?php

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:29
 */
class MediaTest extends PHPUnit_Framework_TestCase
{

    public function testCanCheckInFromMovieObject()
    {
        $movie = movie();
        $checkIn = $movie->checkIn();

        $this->assertInstanceOf("Wubs\\Trakt\\Response\\CheckIn", $checkIn);
    }

    public function testCanCheckOutFromMovieObject()
    {
        $movie = movie();

        $response = $movie->checkOut();

        $this->assertTrue($response);
    }
}
