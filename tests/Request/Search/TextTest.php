<?php
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\Search\Text;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 12:11
 */
class TextTest extends PHPUnit_Framework_TestCase
{
    public function testSearchMovie()
    {
        $id = get_client_id();
        $token = get_token();

        $response = Text::request(
            $id,
            $token,
            Query::set("guardians of the galaxy"),
            Type::movie(),
            Year::set("2014")
        );

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Movie", $response[0]);
    }

    public function testSearchShow()
    {
        $id = get_client_id();
        $token = get_token();

        $response = Text::request(
            $id,
            $token,
            Query::set("hannibal"),
            Type::show()
        );
        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Show", $response[0]);
    }

    public function testSearchEpisode()
    {
        $id = get_client_id();
        $token = get_token();

        $response = Text::request(
            $id,
            $token,
            Query::set("hannibal"),
            Type::episode()
        );

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Episode", $response[0]);
    }
}
