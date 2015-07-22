<?php
namespace Wubs\Trakt\Request\Comments;

use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\DefaultDeleteHandler;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:01
 */
class Delete extends AbstractRequest
{
    /**
     * @var
     */
    private $commentId;

    /**
     * @param AccessToken $token
     * @param $commentId
     */
    public function __construct(AccessToken $token, $commentId)
    {
        parent::__construct();
        $this->commentId = $commentId;
        $this->setToken($token);
        $this->setResponseHandler(new DefaultDeleteHandler());
    }

    public function getRequestType()
    {
        return RequestType::DELETE;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->commentId;
    }

    public function getUri()
    {
        return 'comments/:id';
    }


}