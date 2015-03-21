<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:29
 */

namespace Wubs\Trakt\Response\Handlers;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;

class DefaultResponseHandler extends AbstractResponseHandler implements ResponseHandler
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handle(ResponseInterface $response)
    {
        return $this->getJson($response);
    }
}