<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 15:56
 */

namespace Wubs\Trakt\Response\CheckIn;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Response\ResponseHandler;

class CheckOutHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response)
    {
        return ($response->getStatusCode() === 204);
    }
}