<?php


namespace Wubs\Trakt\Request\Users;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Requests extends AbstractRequest
{


    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "users/requests";
    }
}