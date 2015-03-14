<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:30
 */

namespace Wubs\Trakt\Media;


abstract class Media
{
    public abstract function __construct($json);

    public abstract function getTitle();

    public abstract function getIds();

    public static function search($searchParam)
    {
        return new static("{}");
    }
}