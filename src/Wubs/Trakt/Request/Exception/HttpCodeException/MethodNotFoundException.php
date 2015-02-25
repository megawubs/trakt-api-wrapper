<?php
namespace Wubs\Trakt\Request\Exception\HttpCodeException;


class MethodNotFoundException extends \Exception
{

    protected $message = "Method Not Found - method doesn't exist";

}
