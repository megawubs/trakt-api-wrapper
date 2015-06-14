<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:04
 */

namespace Wubs\Trakt\Request\Scrobble;


use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\AbstractRequest;

class Stop extends AbstractRequest
{
    use ScrobblerTrait;

    /**
     * @param Media $media
     */
    public function __construct(Media $media)
    {
        parent::__construct();
        $this->media = $media;
    }

    public function getUri()
    {
        return "scrobble/stop";
    }


}