<?php
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\RequestType;
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
        $request = new Text(
            "guardians of the galaxy",
            Type::movie(),
            "2014"
        );

        $this->assertEquals(RequestType::GET, $request->getRequestType());

        $this->assertEquals("search", $request->getUrl());
    }
}
