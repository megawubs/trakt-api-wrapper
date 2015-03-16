<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 16/03/15
 * Time: 17:16
 */

namespace Wubs\Trakt\Exception;


class MediaTypeNotSupportedException extends \Exception
{
    protected $message = "The response object contains a type that is not (yet) supported";
}