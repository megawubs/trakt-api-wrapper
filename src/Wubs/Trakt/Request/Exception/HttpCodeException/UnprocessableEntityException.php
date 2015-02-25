<?php
namespace Wubs\Trakt\Request\Exception\HttpCodeException;


class UnprocessableEntityException extends \Exception
{

    protected $message = "Unprocessable Entity - validation errors";

}
