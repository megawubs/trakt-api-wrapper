<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 15:49
 */

namespace Wubs\Trakt\Request\CheckIn;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\CheckIn\CheckOutHandler;

class CheckOut extends AbstractRequest
{

    public function getRequestType()
    {
        return RequestType::DELETE;
    }

    public function getUrl()
    {
        return "checkin";
    }

    protected function getResponseHandler()
    {
        return CheckOutHandler::class;
    }


}