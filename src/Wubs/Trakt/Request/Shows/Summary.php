<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:56
 */

namespace Wubs\Trakt\Request\Shows;

use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Movies\SummaryHandler;

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
        $this->setResponseHandler(new SummaryHandler());
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "shows/:id";
    }
}