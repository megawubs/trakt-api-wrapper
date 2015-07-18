<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:03
 */

namespace Wubs\Trakt\Response\Handlers;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Parameters\AbstractParameter;

class DefaultDeleteHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @param ClientInterface|GuzzleHttp\ClientInterface $client
     * @return bool
     * @internal param ClientInterface $client
     */
    public function handle(ResponseInterface $response, \GuzzleHttp\ClientInterface $client)
    {
        return ($response->getStatusCode() === 204);
    }
}