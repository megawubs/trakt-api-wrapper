<?php
use Carbon\Carbon;
use Guzzle\Http\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Calendars\MyMovies;
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
        $request = new MyMovies(get_token());
        $request->setResponseHandler(new MyResponseHandler());

        $handler = $request->getResponseHandler();

        $this->assertInstanceOf(MyResponseHandler::class, $handler);
    }

    public function testCanSetResponseHandlerOnStaticRequest()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
//        $request = Mockery::mock(stdClass::class . ", " . RequestInterface::class);
//        $response = Mockery::mock(stdClass::class . ", " . ResponseInterface::class);
//
//        $client->shouldReceive("createRequest")->once()->andReturn($request);
//        $response->shouldReceive("json")->once()->andReturn([]);
//        $trakt = new Trakt(getenv("CLIENT_ID"), $client);
        $response = (new MyMovies(get_token()))->make(get_client_id(), $client, new MyResponseHandler());

        $this->assertTrue($response);
    }

    public function testCanOmitTokenAsParameter()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $response = (new MyMovies(get_token(), Carbon::today(), 20))->make(
            get_client_id(),
            $client,
            new MyResponseHandler()
        );

        $this->assertTrue($response);
    }

    public function testCanOmitRequestParametersAsParameter()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $response = (new MyMovies(get_token()))->make(get_client_id(), $client, new MyResponseHandler());

        $this->assertTrue($response);
    }

    public function testOnlyPassRequestParameters()
    {
        $client = Mockery::mock(stdClass::class . ", " . ClientInterface::class);
        $response = (new MyMovies(get_token(), Carbon::now(), 20))->make(get_client_id(), $client);

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