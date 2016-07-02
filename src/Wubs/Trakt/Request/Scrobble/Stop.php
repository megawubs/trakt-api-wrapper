<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:04
 */

namespace Wubs\Trakt\Request\Scrobble;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\AbstractRequest;

class Stop extends AbstractRequest
{
    use ScrobblerTrait;
    /**
     * @var
     */
    private $progress;

    /**
     * @param AccessToken $token
     * @param Media $media
     * @param $progress
     */
    public function __construct(AccessToken $token, Media $media, $progress)
    {
        parent::__construct();
        $this->setToken($token);
        $this->media = $media;
        $this->progress = $progress;
    }

    public function getUri()
    {
        return "scrobble/stop";
    }

}
