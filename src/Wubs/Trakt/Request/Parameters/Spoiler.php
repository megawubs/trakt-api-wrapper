<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 16:54
 */

namespace Wubs\Trakt\Request\Parameters;


class Spoiler extends AbstractParameter implements Parameter
{

    public static function standard()
    {
        return new static(false);
    }

    public static function false()
    {
        return new static(false);
    }

    public static function true()
    {
        return new static(false);
    }
}