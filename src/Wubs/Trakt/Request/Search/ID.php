<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:12
 */

namespace Wubs\Trakt\Request\Search;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\IdType;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\RequestType;

class ID extends AbstractRequest
{

    /**
     * @param IdType $idType
     * @param MediaId $id
     */
    public function __construct(IdType $idType, MediaId $id)
    {
        $this->setQueryParams(
            [
                "id_type" => $idType,
                "id" => $id
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