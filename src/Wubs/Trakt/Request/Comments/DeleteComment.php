<?php
namespace Wubs\Trakt\Request\Comments;

use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\CommentId;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\DeleteHandler;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:01
 */
class DeleteComment extends AbstractRequest
{
    /**
     * @var CommentId
     */
    private $id;

    /**
     * @param CommentId $id
     */
    public function __construct(CommentId $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::DELETE;
    }

    public function getUrl()
    {
        return 'comments/' . $this->id;
    }

    protected function getResponseHandler()
    {
        return DeleteHandler::class;
    }


}