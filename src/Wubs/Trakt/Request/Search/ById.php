<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 21/03/15
 * Time: 10:12
 */

namespace Wubs\Trakt\Request\Search;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Search\SearchHandler;

class ById extends AbstractRequest
{

    /**
     * @param string $idType
     * @param $mediaId
     */
    public function __construct($idType, $mediaId, AccessToken $token = null)
    {
        parent::__construct();
        $this->setQueryParams(
            [
                "id_type" => $idType,
                "id" => $mediaId
            ]
        );
        if ($token !== null) {
            $this->setToken($token);
        }
        $this->setResponseHandler(new SearchHandler());
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