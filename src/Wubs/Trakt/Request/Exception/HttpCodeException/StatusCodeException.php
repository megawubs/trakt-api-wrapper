<?php
namespace Wubs\Trakt\Request\Exception\HttpCodeException;


class StatusCodeException extends \Exception
{

    protected $message = 'Unknown http status error code obtained: %s';

    public function __construct($code) {
        parent::__construct(sprintf($this->message,$code));
    }

}
