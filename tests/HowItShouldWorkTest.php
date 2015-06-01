<?php
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
    public function testRequestShouldNotBeAbleToCallItself()
    {
        $request = new DescribesRequest();

        $maker = new ExecutesRequest($request);

        $response = $maker->handleResponse(new MyResponseHandler());
    }
}
