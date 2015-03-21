<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:09
 */

namespace Wubs\Trakt\Request\Comments;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Exception\CommentTooShortException;
use Wubs\Trakt\Request\Parameters\Comment;
use Wubs\Trakt\Request\Parameters\CommentId;
use Wubs\Trakt\Request\Parameters\Spoiler;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Comments\CommentHandler;

class UpdateComment extends AbstractRequest
{
    use CommentSize;
    /**
     * @var CommentId
     */
    private $id;
    /**
     * @var Comment
     */
    private $comment;
    /**
     * @var Spoiler
     */
    private $spoiler;

    /**
     * @param CommentId $id
     * @param Comment $comment
     * @param Spoiler $spoiler
     * @throws CommentTooShortException
     */
    public function __construct(CommentId $id, Comment $comment, Spoiler $spoiler)
    {

        $this->id = $id;
        $this->comment = $comment;
        $this->spoiler = $spoiler;

        if ($this->commentIsNotAllowedSize()) {
            throw new CommentTooShortException;
        }
    }

    public function getRequestType()
    {
        return RequestType::PUT;
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
        return "comments/:id";
    }

    protected function getResponseHandler()
    {
        return CommentHandler::class;
    }


    protected function getPostBody()
    {
        return [
            "comment" => $this->comment,
            "spoiler" => $this->spoiler
        ];
    }


}