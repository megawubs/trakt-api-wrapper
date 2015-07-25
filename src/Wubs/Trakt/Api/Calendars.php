<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api;

use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\Movies as MoviesRequest;
use Wubs\Trakt\Request\Calendars\Shows as ShowsRequest;

class Calendars extends Endpoint
{

    /**
     * @var \Wubs\Trakt\Api\Calendars\My
     */
    public $my;

    /**
     * @var \Wubs\Trakt\Api\Calendars\Shows
     */
    public $shows;

    public function movies(Carbon $startDate = null, $days = null)
    {
        return $this->request(new MoviesRequest($startDate, $days));
    }

    public function shows(Carbon $startDate = null, $days = null)
    {
        return $this->request(new ShowsRequest($startDate, $days));
    }

}

