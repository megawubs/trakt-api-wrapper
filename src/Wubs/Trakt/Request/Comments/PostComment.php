<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 16:08
 */

namespace Wubs\Trakt\Request\Comments;


use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Exception\CommentTooShortException;
use Wubs\Trakt\Request\Parameters\Comment;
use Wubs\Trakt\Request\Parameters\Spoiler;
use Wubs\Trakt\Request\RequestType;

class PostComment extends AbstractRequest
{

    use CommentSize;
    /**
     * @var Comment
     */
    private $comment;
    /**
     * @var Media
     */
    private $media;
    /**
     * @var Spoiler
     */
    private $spoiler;

    /**
     * @param Media $media
     * @param Comment $comment
     * @param Spoiler $spoiler
     * @throws CommentTooShortException
     */
    public function __construct(Media $media, Comment $comment, Spoiler $spoiler)
    {
        parent::__construct();

        $this->comment = $comment;
        $this->media = $media;
        $this->spoiler = $spoiler;

        if ($this->commentIsNotAllowedSize()) {
            throw new CommentTooShortException;
        }

    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUri()
    {
        return "comments";
    }

    protected function getPostBody()
    {
        $postBody = [
            'movie' => $this->media->getStandardFields(),
            'comment' => (string)$this->comment,
            'spoiler' => false,
            'review' => $this->isReview()
        ];

        return $postBody;
    }

    /**
     * @return int
     */
    protected function isReview()
    {
        return (strlen($this->comment) > 200);
    }
}