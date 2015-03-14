<?php
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\Movies\CheckIn;
use Wubs\Trakt\Request\Parameters\Query;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 19:26
 */
class CheckInTest extends PHPUnit_Framework_TestCase
{
    public function testStaticCall()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $movie = Movie::search(Query::set("guardians-of-the-galaxy-2014"));

        $response = CheckIn::request($id, $token, $movie);
        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Episode", $response[0]);
    }
}
