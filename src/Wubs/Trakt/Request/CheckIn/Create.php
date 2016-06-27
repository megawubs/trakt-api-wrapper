<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 13/03/15
 * Time: 17:39
 */

namespace Wubs\Trakt\Request\CheckIn;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\CheckIn\CheckInHandler;

class Create extends AbstractRequest
{
    /**
     * @var Movie
     */
    private $media;
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
     * @param Media $media
     * @param $message
     * @param array $sharing
     * @param $venueId
     * @param $venueName
     * @param $appVersion
     * @param $appDate
     */
    public function __construct(
        AccessToken $token,
        Media $media,
        $message = null,
        array $sharing = [],
        $venueId = null,
        $venueName = null,
        $appVersion = null,
        $appDate = null
    ) {
        parent::__construct();
        $this->media = $media;
        $this->setToken($token);

        $this->setResponseHandler(new CheckInHandler());
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
        $type = $this->media->getType();
        return [
            $type => $this->media->getStandardFields(),
            "sharing" => $this->sharing,
            "message" => $this->message,
            "venue_id" => $this->venueId,
            "app_version" => $this->appVersion,
            "app_date" => $this->appDate
        ];
    }
}