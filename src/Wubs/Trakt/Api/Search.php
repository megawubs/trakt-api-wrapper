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

use Wubs\Trakt\Request\Search\ID as IDRequest;
use Wubs\Trakt\Request\Search\Text as TextRequest;

class Search extends Endpoint {

    public function iD($idType, $mediaId)
    {
        return $this->request(new IDRequest($idType, $mediaId));
    }

	public function text($query, $type, $year)
    {
        return $this->request(new TextRequest($query, $type, $year));
    }

}

