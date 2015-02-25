<?php
namespace Wubs\Trakt\Request\Exception;


class RequestCallException extends \Exception
{

    protected $message = 'Request as failed check stack for more information';

    public function __construct(\Exception $previousException)
    {
        parent::__construct($this->message, 0, $previousException);
    }

}
