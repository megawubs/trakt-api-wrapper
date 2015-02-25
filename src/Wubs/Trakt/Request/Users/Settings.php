<?php namespace Wubs\Trakt\Request\Users;

use GuzzleHttp\Message\Response;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 13:42
 */
class Settings extends AbstractRequest
{

    protected function handleResponse(ResponseInterface $response)
    {
        var_dump($response->json());
    }

    public function getMethod()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "users/settings";
    }
}