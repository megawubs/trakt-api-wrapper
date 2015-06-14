<?php
namespace Wubs\Trakt\Request\Comments;

use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\DefaultDeleteHandler;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:01
 */
class DeleteComment extends AbstractRequest
{
    /**
     * @var
     */
    private $commentId;

    /**
     * @param $commentId
     */
    public function __construct($commentId)
    {
        parent::__construct();
        $this->commentId = $commentId;
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