<?php

use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\CheckIn\CheckOut;
use Wubs\Trakt\Request\CheckIn\MovieCheckIn;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\Search\Text;
use Wubs\Trakt\Response\CheckIn;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 15:52
 */
class CheckInTest extends PHPUnit_Framework_TestCase
{

    public function testCheckIn()
    {

        /** @var Movie $movie */
        $movie = movie();

        $response = $movie->checkIn();

        $this->assertInstanceOf(CheckIn::class, $response);
    }

    public function testCheckOut()
    {
        $id = get_client_id();
        $token = get_token();

        $response = (new CheckOut())->make($id, $token);

        $this->assertTrue($response);
    }

}
