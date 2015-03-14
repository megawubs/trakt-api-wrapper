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
use Wubs\Trakt\Response\CheckIn\CheckInHandler;

class MovieCheckIn extends AbstractRequest
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
        $postBody = ['movie' => $movie->getStandardFields()];
        $this->setPostBody($postBody);
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUrl()
    {
        return "checkin";
    }

    protected function getResponseHandler()
    {
        return CheckinHandler::class;
    }

}