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
    public $score;

    public $title;

    public $overview;

    public $year;

    public $images;

    public $fanart;

    protected $standard = ["title", "year", "ids"];

}