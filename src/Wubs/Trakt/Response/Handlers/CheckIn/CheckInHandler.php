<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:17
 */

namespace Wubs\Trakt\Response\Handlers\CheckIn;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\CheckIn;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class CheckInHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @return CheckIn
     */
    public function handle(ResponseInterface $response)
    {
        $object = $this->getJson($response);

        return new CheckIn($object, $this->getId(), $this->getToken());
    }
}