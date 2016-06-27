<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:07
 */

namespace Wubs\Trakt\Request\Scrobble;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Scrobble\ScrobbleHandler;

class Pause extends AbstractRequest
{
    use ScrobblerTrait;

    /**
     * Start constructor.
     * @param AccessToken $token
     * @param Media $media
     * @param int $progress
     * @param null $appVersion
     * @param null $appDate
     */
    public function __construct(
        AccessToken $token,
        Media $media,
        $progress = 0,
        $appVersion = null,
        $appDate = null
    ) {
        parent::__construct();
        $this->setToken($token);
        $this->media = $media;

        $this->setResponseHandler(new ScrobbleHandler());

        $this->progress = $progress;
        $this->appDate = $appDate;
        $this->appVersion = $appVersion;

    }

    public function getUri()
    {
        return "scrobble/pause";
    }
}