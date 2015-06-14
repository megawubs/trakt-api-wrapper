<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 15:49
 */

namespace Wubs\Trakt\Request\CheckIn;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\CheckIn\CheckOutHandler;
use Wubs\Trakt\Response\Handlers\DefaultDeleteHandler;

class Delete extends AbstractRequest
{
    public function __construct(AccessToken $token)
    {
        parent::__construct();
        $this->setResponseHandler(new DefaultDeleteHandler());
        $this->setToken($token);
    }

    public function getRequestType()
    {
        return RequestType::DELETE;
    }

    public function getUri()
    {
        return "checkin";
    }
}