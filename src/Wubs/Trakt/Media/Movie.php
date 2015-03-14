<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:30
 */

namespace Wubs\Trakt\Media;


class Movie extends Media
{

    protected $standard = ["title", "year", "ids"];

    public function getTitle()
    {
        return $this->json->movie->title;
    }

    public function getIds()
    {
        return $this->json->movie->ids;
    }
}