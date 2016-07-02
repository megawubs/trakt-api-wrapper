<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:08
 */

namespace Wubs\Trakt\Request\Scrobble;

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\RequestType;

trait ScrobblerTrait
{
    /**
     * @var Media
     */
    private $media;

    /**
     * @var int
     */
    private $progress;

    protected function getPostBody()
    {
        return [
            $this->media->getType() => $this->media->getStandardFields(),
            'progress' => $this->progress
        ];
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }
}
