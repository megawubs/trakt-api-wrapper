<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:29
 */

namespace Wubs\Trakt\Response\Handlers;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use Wubs\Trakt\Contracts\ResponseHandler;

class DefaultResponseHandler extends AbstractResponseHandler implements ResponseHandler
{
    /**
     * @param ResponseInterface $response
     * @param ClientInterface $client
     * @return Collection
     * @internal param ClientInterface $client
     */
    public function handle(ResponseInterface $response, ClientInterface $client)
    {
        $json = $this->getJson($response);
        return (is_array($json)) ? collect($json) : collect([$json]);
    }
}
