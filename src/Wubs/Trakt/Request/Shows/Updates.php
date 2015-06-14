<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 27/03/15
 * Time: 11:44
 */

namespace Wubs\Trakt\Request\Shows;


use Carbon\Carbon;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\TimePeriod;
use Wubs\Trakt\Request\RequestType;

class Updates extends AbstractRequest
{
    use TimePeriod;

    public function __construct(Carbon $date = null)
    {
        parent::__construct();
        $this->setStartDate($date);
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "shows/updates/:start_date";
    }
}