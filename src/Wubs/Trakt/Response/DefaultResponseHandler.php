<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 26/02/15
 * Time: 00:29
 */

namespace Wubs\Trakt\Response;


use GuzzleHttp\Message\ResponseInterface;

class DefaultResponseHandler implements Response
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     */
    public function handle(ResponseInterface $response)
    {
        return $response->json();
    }
}