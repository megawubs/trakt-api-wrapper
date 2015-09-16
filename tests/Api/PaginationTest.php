<?php


use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Api\Movies;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Movies\Collected;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;
use Wubs\Trakt\TraktHttpClient;

class PaginationTest extends PHPUnit_Framework_TestCase
{


    public function testCanPaginatePaginatableMethod()
    {
        $movies = new Collected();

        $movies->setPage(2);
        $movies->setLimit(15);

        $movies->setResponseHandler(new PaginationTestResponseHandler());

        $response = $movies->make(get_client_id(), TraktHttpClient::make());

        $this->assertEquals('2', $response->getHeader('X-Pagination-Page'));
        $this->assertEquals('10', $response->getHeader('X-Pagination-Limit'));
    }
}

class PaginationTestResponseHandler extends AbstractResponseHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response, \GuzzleHttp\ClientInterface $client)
    {
        return $response;
    }
}
