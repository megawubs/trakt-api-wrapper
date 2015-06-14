<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 17:39
 */

namespace Wubs\Trakt\Request\CheckIn;


use League\OAuth2\Client\Token\AccessToken;
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
     * @var
     */
    private $venueId;
    /**
     * @var
     */
    private $appDate;
    /**
     * @var
     */
    private $appVersion;
    /**
     * @var
     */
    private $message;
    /**
     * @var array
     */
    private $sharing;
    /**
     * @var
     */
    private $venueName;


    /**
     * @param AccessToken $token
     * @param Movie $movie
     * @param array $sharing
     * @param $message
     * @param $venueId
     * @param $venueName
     * @param $appVersion
     * @param $appDate
     */
    public function __construct(
        AccessToken $token,
        Movie $movie,
        array $sharing = [],
        $message,
        $venueId,
        $venueName,
        $appVersion,
        $appDate
    ) {
        parent::__construct();
        $this->movie = $movie;
        $this->setToken($token);

        $this->setResponseHandler(new CheckinHandler());
        $this->venueId = $venueId;
        $this->appDate = $appDate;
        $this->appVersion = $appVersion;
        $this->message = $message;
        $this->sharing = $sharing;
        $this->venueName = $venueName;
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
        return [
            'movie' => $this->movie->getStandardFields(),
            "sharing" => $this->sharing,
            "message" => $this->message,
            "venue_id" => $this->venueId,
            "app_version" => $this->appVersion,
            "app_date" => $this->appDate
        ];
    }
}