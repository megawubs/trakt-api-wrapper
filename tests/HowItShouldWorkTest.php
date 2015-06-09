<?php
use Wubs\Trakt\Contracts\ExecutesRequest;
use Wubs\Trakt\Request\DescribesRequest;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 02/04/15
 * Time: 18:45
 */
class HowItShouldWorkTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException Wubs\Trakt\Request\Exception\HttpCodeException\MethodNotFoundException;
     */
    public function testHowItShouldWork()
    {
        $request = new DescribesRequest();

        $executed = new ExecutesRequest($request, new MyResponseHandler());

        $response = $executed->getResponse();

        $this->assertEquals("200", $response);
    }
}
