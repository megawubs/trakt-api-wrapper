<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 27/03/15
 * Time: 11:57
 */

namespace Wubs\Trakt\Request\Shows\Progress;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;

class Collection extends AbstractRequest
{

    use MediaIdTrait;

    /**
     * @param  $mediaId
     */
    public function __construct(AccessToken $token, $mediaId)
    {
        parent::__construct();
        $this->setToken($token);
        $this->id = $mediaId;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "shows/:id/progress/collection";
    }
}