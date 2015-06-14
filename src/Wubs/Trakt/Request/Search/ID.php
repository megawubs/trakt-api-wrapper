<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:12
 */

namespace Wubs\Trakt\Request\Search;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class ID extends AbstractRequest
{

    /**
     * @param string $idType
     * @param $mediaId
     */
    public function __construct($idType, $mediaId)
    {
        $this->setQueryParams(
            [
                "id_type" => $idType,
                "id" => $mediaId
            ]
        );
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "search";
    }
}