<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 16/03/15
 * Time: 23:32
 */

namespace Wubs\Trakt\Exception;


class MalformedParameterException extends \Exception
{

    protected $message = "Trying to access a getter that does not exists on the request object";
}