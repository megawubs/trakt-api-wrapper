<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:47
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Movies\UpdatedHandler;

class Updated extends AbstractRequest
{
    public function __construct()
    {
        parent::__construct();
        $this->setResponseHandler(new UpdatedHandler());
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "movies/updated";
    }
}