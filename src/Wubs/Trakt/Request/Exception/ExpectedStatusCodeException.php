<?php
namespace Wubs\Trakt\Request\Exception;


class ExpectedStatusCodeException extends \Exception
{

    protected $message = 'Wrong Status code Obtained: %s. Status code expected: %s';

    public function __construct($wrongCode, $expectedCode)
    {
        parent::__construct(sprintf($this->message,$wrongCode,$expectedCode));
    }

}
