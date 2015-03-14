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
    public function testStaticCall()
    {
        $id = getenv("CLIENT_ID");
        $token = get_token();

        $response = Text::request(
            $id,
            $token,
            Query::set("guardians of the galaxy"),
            Type::movie(),
            Year::set("2014")
        );

        $this->assertInstanceOf("Wubs\\Trakt\\Media\\Movie", $response[0]);
//        $this->assertEquals("2014", $response[0]['movie']['year']);
    }
}
