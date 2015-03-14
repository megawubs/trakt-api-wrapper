<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 12:13
 */

namespace Wubs\Trakt\Request\Parameters;


class Query extends AbstractParameter implements Parameter
{

    public static function standard()
    {
        return new static("foo");
    }
}