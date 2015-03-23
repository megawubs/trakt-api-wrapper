<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 16/03/15
 * Time: 17:36
 */

namespace Wubs\Trakt\Media;


class Season extends Media
{

    protected $standard = ["number", "ids"];

    public function getTitle()
    {
        return $this->media->number;
    }

    public function getIds()
    {
        return $this->media->ids;
    }
}