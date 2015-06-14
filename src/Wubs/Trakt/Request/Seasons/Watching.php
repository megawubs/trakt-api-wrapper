<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 27/03/15
 * Time: 12:00
 */

namespace Wubs\Trakt\Request\Seasons;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;

class Watching extends AbstractRequest
{
    use MediaIdTrait;
    /**
     * @var Season
     */
    private $season;

    /**
     * @param int $mediaId
     * @param int $season
     */
    public function __construct($mediaId, $season)
    {
        parent::__construct();
        $this->id = $mediaId;
        $this->season = $season;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    /**
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    public function getUri()
    {
        return "shows/:id/seasons/:season/watching";
    }
}