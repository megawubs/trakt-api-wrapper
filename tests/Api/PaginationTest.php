<?php


use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Api\Movies;
use Wubs\Trakt\Api\Users;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Movies\Collected;
use Wubs\Trakt\Request\Users\History;
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

        /** @var ResponseInterface $response */
        $response = $movies->make(get_client_id(), TraktHttpClient::make());
        $url = $response->getEffectiveUrl();
        $movies = collect($response->json(['object' => true]));

        $this->assertEquals('2', $response->getHeader('X-Pagination-Page'));
        $this->assertEquals('15', $response->getHeader('X-Pagination-Limit'));
        $this->assertContains("limit=15", $url);
        $this->assertContains("page=2", $url);

        $this->assertCount(15, $movies);
    }
}

class PaginationTestResponseHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @param \GuzzleHttp\ClientInterface $client
     * @return ResponseInterface
     */
    public function handle(ResponseInterface $response, \GuzzleHttp\ClientInterface $client)
    {
        return $response;
    }
}
