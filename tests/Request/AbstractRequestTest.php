<?php
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Calendars\Movies;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\StartDate;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 23/03/15
 * Time: 18:11
 */
class AbstractRequestTest extends PHPUnit_Framework_TestCase
{

    public function testCanRegisterResponseHandler()
    {
        $request = new Movies();
        $request->setResponseHandler(new MyResponseHandler());

        $handler = $request->getResponseHandler();

        $this->assertInstanceOf(MyResponseHandler::class, $handler);
    }

    public function testCanSetResponseHandlerOnStaticRequest()
    {
        $response = (new Movies())->make(get_client_id(), get_token(), new MyResponseHandler());

        $this->assertTrue($response);
    }

    public function testCanOmitTokenAsParameter()
    {
        $response = (new Movies(StartDate::standard(), Days::set(20)))->make(
            get_client_id(),
            new MyResponseHandler
            ()
        );

        $this->assertTrue($response);
    }

    public function testCanOmitRequestParametersAsParameter()
    {
        $response = (new Movies())->make(get_client_id(), new MyResponseHandler());

        $this->assertTrue($response);
    }

    public function testOnlyPassRequestParameters()
    {
        $response = (new Movies(StartDate::standard(), Days::set(20)))->make(get_client_id());

        $this->assertInstanceOf(Wubs\Trakt\Response\Calendar\Calendar::class, $response);
    }

}


class MyResponseHandler extends AbstractResponseHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response)
    {
        return true;
    }
}