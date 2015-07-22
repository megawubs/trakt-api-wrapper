<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:17
 */

namespace Wubs\Trakt\Response\Handlers\CheckIn;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\CheckIn;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class CheckInHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @param $client
     * @return CheckIn
     */
    public function handle(ResponseInterface $response, ClientInterface $client)
    {
        $object = $this->getJson($response);

        return new CheckIn($object, $this->getClientId(), $this->getToken(), $client);
    }
}