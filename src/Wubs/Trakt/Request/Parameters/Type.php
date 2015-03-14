<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 13:12
 */

namespace Wubs\Trakt\Request\Parameters;


class Type extends AbstractParameter implements Parameter
{

    public static function movies()
    {
        return new static("movies");
    }

    public static function movie()
    {
        return new static("movie");
    }

    public static function shows()
    {
        return new static("shows");
    }

    public static function show()
    {
        return new static("show");
    }

    public static function episode()
    {
        return new static("episode");
    }

    public static function _list()
    {
        return new static("list");
    }

    public static function standard()
    {
        return static::shows();
    }
}