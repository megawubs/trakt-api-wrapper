<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 16:15
 */

namespace Wubs\Trakt\Request\Parameters;


class Comment extends AbstractParameter implements Parameter
{

    public static function standard()
    {
        return new static("");
    }
}