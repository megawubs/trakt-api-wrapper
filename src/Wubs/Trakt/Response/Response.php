<?php namespace Wubs\Trakt\Response;

use GuzzleHttp\Message\ResponseInterface;


/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 17:24
 */
interface Response
{
    public function handle(ResponseInterface $response);
}