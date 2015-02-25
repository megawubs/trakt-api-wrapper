<?php
namespace Wubs\Trakt\Request\Exception\HttpCodeException;


class ServerUnavailableException extends \Exception
{

    protected $message = "Service Unavailable - server overloaded";

}
