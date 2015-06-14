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
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Comments\CommentHandler;

class UpdateComment extends AbstractRequest
{
    use CommentSize;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $comment;
    /**
     * @var bool
     */
    private $spoiler;

    /**
     * @param int $commentId
     * @param string $comment
     * @param bool $spoiler
     * @throws CommentTooShortException
     */
    public function __construct($commentId, $comment, $spoiler)
    {

        $this->id = $commentId;
        $this->comment = $comment;
        $this->spoiler = $spoiler;
        $this->setResponseHandler(new CommentHandler());

        if ($this->commentIsNotAllowedSize()) {
            throw new CommentTooShortException;
        }
    }

    public function getRequestType()
    {
        return RequestType::PUT;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUri()
    {
        return "comments/:id";
    }

    protected function getPostBody()
    {
        return [
            "comment" => $this->comment,
            "spoiler" => $this->spoiler
        ];
    }


}