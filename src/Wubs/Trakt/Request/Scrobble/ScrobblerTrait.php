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

    protected function getPostBody()
    {
        $type = $this->media->getType();
        return [
            $type => $this->media->getStandardFields(),
            "progress" => 0,
            "app_version" => 0,
            "app_date" => 0
        ];
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }
}