<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 02/04/15
 * Time: 18:46
 */

namespace Wubs\Trakt\Request;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Contracts\Request;
use Wubs\Trakt\Request\Exception\HttpCodeException\MethodNotFoundException;

class DescribesRequest implements Request
{

    private $params = [];

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        throw new MethodNotFoundException;
    }

    public function setQueryParams(array $params)
    {
        $this->params = $params;
    }
}