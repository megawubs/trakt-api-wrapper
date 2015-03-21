<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:13
 */

namespace Wubs\Trakt\Request\Parameters;


class IdType extends AbstractParameter
{
    public static function  imdb()
    {
        return new static("imdb");
    }

    public static function traktMovie()
    {
        return new static("trakt-movie");
    }

    public static function traktShow()
    {
        return new static("trakt-show");
    }

    public static function traktEpisode()
    {
        return new static("trakt-episode");
    }

    public static function tmdb()
    {
        return new static("tmdb");
    }

    public static function tvdb()
    {
        return new static("tvdb");
    }

    public static function tvrage()
    {
        return new static("tvgrage");
    }

}