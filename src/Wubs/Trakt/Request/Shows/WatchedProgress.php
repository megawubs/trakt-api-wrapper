<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 27/03/15
 * Time: 11:57
 */

namespace Wubs\Trakt\Request\Shows;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;

class WatchedProgress extends AbstractRequest
{

    use MediaIdTrait;

    /**
     * @param MediaId $id
     */
    public function __construct(MediaId $id)
    {
        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "shows/:id/progress/watched";
    }
}