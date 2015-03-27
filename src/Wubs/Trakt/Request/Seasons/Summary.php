<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 27/03/15
 * Time: 12:00
 */

namespace Wubs\Trakt\Request\Seasons;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;

class Summary extends AbstractRequest
{
    use MediaIdTrait;

    /**
     * @param MediaId $id
     */
    public function __construct(MediaId $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "shows/:id/seasons";
    }
}