<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 17:39
 */

namespace Wubs\Trakt\Request\CheckIn;


use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\CheckIn\CheckInHandler;

class Create extends AbstractRequest
{
    /**
     * @var Movie
     */
    private $movie;


    /**
     * @param Movie $movie
     */
    public function __construct(Movie $movie)
    {
        parent::__construct();
        $this->movie = $movie;
        $this->setResponseHandler(new CheckinHandler());
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUri()
    {
        return "checkin";
    }

    protected function getPostBody()
    {
        return ['movie' => $this->movie->getStandardFields()];
    }
}