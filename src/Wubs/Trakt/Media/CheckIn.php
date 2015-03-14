<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:18
 */

namespace Wubs\Trakt\Media;


class CheckIn extends Media
{

    /**
     * @var Movie
     */
    public $movie;

    private $sharing;

    public function __construct($json)
    {
        parent::__construct($json);
        $this->movie = new Movie($json->movie);

        $this->sharing = $json->sharing;
    }

    public function getTitle()
    {
        return $this->movie->getTitle();
    }

    public function getIds()
    {
        return $this->movie->getIds();
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function isSharedOnFacebook()
    {
        return $this->isSharedOn("facebook");
    }

    public function isSharedOnTwitter()
    {
        return $this->isSharedOn("twitter");
    }

    public function isSharedOnTumblr()
    {
        return $this->isSharedOn("tumblr");
    }

    private function isSharedOn($medium)
    {
        return $this->sharing->{$medium};
    }
}