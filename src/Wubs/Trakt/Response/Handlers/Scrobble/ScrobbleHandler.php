<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:17
 */

namespace Wubs\Trakt\Response\Handlers\Scrobble;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class ScrobbleHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @param $client
     */
    public function handle(ResponseInterface $response, ClientInterface $client)
    {
        $object = $this->getJson($response);
        echo '<pre>'; var_dump($object); echo '</pre>';
        return $object;
    }
}