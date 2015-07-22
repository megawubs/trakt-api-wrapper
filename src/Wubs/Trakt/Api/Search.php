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

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Search\ID as IDRequest;
use Wubs\Trakt\Request\Search\Text as TextRequest;

class Search extends Endpoint {

    

    public function iD($idType, $mediaId, AccessToken $token = null)
    {
        return $this->request(new IDRequest($idType, $mediaId, $token));
    }

	public function text($query, $type = null, $year = null, AccessToken $token = null)
    {
        return $this->request(new TextRequest($query, $type, $year, $token));
    }

}

