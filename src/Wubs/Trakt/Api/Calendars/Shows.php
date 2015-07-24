<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Calendars;

use Carbon\Carbon;
use Wubs\Trakt\Request\Calendars\Shows\NewShows as NewShowsRequest;
use Wubs\Trakt\Request\Calendars\Shows\Premieres as PremieresRequest;
use Wubs\Trakt\Api\Endpoint;

class Shows extends Endpoint {
    


    public function newShows(Carbon $startDate = null, $days = null)
    {
        return $this->request(new NewShowsRequest($startDate, $days));
    }

	public function premieres(Carbon $startDate = null, $days = null)
    {
        return $this->request(new PremieresRequest($startDate, $days));
    }

}

