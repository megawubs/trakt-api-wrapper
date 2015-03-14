<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:17
 */

namespace Wubs\Trakt\Response\CheckIn;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\CheckIn;
use Wubs\Trakt\Response\ResponseHandler;

class CheckInHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response)
    {
        $object = $response->json(['object' => true]);

        return new CheckIn($object);
    }
}