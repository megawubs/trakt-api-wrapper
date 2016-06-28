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

    private $progress;
    private $appVersion;
    private $appDate;


    protected function getPostBody()
    {
        $type = $this->media->getType();
        return [
            $type => $this->media->getStandardFields(),
            'progress' => $this->progress,
            'app_version' => $this->appVersion,
            'app_date' => $this->appDate
        ];
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

}