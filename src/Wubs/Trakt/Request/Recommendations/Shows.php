<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:00
 */

namespace Wubs\Trakt\Request\Recommendations;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Shows extends AbstractRequest
{

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "recommendations/shows";
    }
}