<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:30
 */

namespace Wubs\Trakt\Media;


use Wubs\Trakt\Response\Response;

class Movie implements Media
{
    public function __construct($json)
    {
    }

    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    public function getIds()
    {
        // TODO: Implement getIds() method.
    }

    public static function find($searchParam)
    {
        // TODO: Implement find() method.
    }
}