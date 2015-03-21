<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:28
 */

namespace Wubs\Trakt\Request\Comments;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\CommentId;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\DefaultDeleteHandler;

class Like extends AbstractRequest
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

        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    /**
     * @return CommentId
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUri()
    {
        return "comments/:id/like";
    }

    protected function getResponseHandler()
    {
        return DefaultDeleteHandler::class;
    }


}