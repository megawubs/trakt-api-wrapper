<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 17:39
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class CheckIn extends AbstractRequest
{
    /**
     * @var Movie
     */
    private $movie;

    /**
     * @param Movie $movie
     */
    public function __construct(Movie $movie){

        $this->movie = $movie;
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUrl()
    {
        return "checkin";
    }
}