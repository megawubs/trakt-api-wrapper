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

use Wubs\Trakt\Request\Search\ID as RequestID;
use Wubs\Trakt\Request\Search\Text as RequestText;

class Search extends Endpoint {

    public function iD( $idType,  $mediaId)
    {
        return $this->request(new RequestID($idType, $mediaId));
    }

	public function text( $query,  $type,  $year)
    {
        return $this->request(new RequestText($query, $type, $year));
    }

}

