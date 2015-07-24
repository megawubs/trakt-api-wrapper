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

use Wubs\Trakt\Request\Recommendations\Movies as MoviesRequest;
use Wubs\Trakt\Request\Recommendations\Shows as ShowsRequest;

class Recommendations extends Endpoint {
    
    /**
     * @var \Wubs\Trakt\Api\Recommendations\Dismiss
    */
    public $dismiss;

    public function movies()
    {
        return $this->request(new MoviesRequest());
    }

	public function shows()
    {
        return $this->request(new ShowsRequest());
    }

}

