<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api\Shows;

use Wubs\Trakt\Request\Shows\Progress\Collection as CollectionRequest;
use Wubs\Trakt\Request\Shows\Progress\Watched as WatchedRequest;
use Wubs\Trakt\Api\Endpoint;

class Progress extends Endpoint {
    


    public function collection($mediaId)
    {
        return $this->request(new CollectionRequest($mediaId));
    }

	public function watched($mediaId)
    {
        return $this->request(new WatchedRequest($mediaId));
    }

}

