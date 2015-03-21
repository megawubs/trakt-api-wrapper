<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:30
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Movies\PopularHandler;

class Popular extends AbstractRequest
{

    public function getRequestType()
    {
        parent::__construct();
        return RequestType::GET;
    }

    public function getUri()
    {
        return "movies/popular";
    }

    protected function getResponseHandler()
    {
        return PopularHandler::class;
    }


}