<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:59
 */

namespace Wubs\Trakt\Response\Handlers\Movies;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class SummaryHandler extends AbstractResponseHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response, \GuzzleHttp\ClientInterface $client)
    {
        $json = $this->getJson($response);

        return new Movie($json, $this->getClientId(), $this->getToken(), $client);
    }
}