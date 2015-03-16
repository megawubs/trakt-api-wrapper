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
use Wubs\Trakt\Request\RequestType;

class PostComment extends AbstractRequest
{
    /**
     * @var Comment
     */
    private $comment;
    /**
     * @var Media
     */
    private $media;

    /**
     * @param Media $media
     * @param Comment $comment
     * @throws CommentTooShortException
     */
    public function __construct(Media $media, Comment $comment)
    {
        parent::__construct();


        $this->comment = $comment;
        $this->media = $media;

        if ($this->commentIsNotAllowedSize()) {
            throw new CommentTooShortException;
        }
    }

    public function getRequestType()
    {
        return RequestType::POST;
    }

    public function getUrl()
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
     * @return bool
     */
    private function commentIsNotAllowedSize()
    {
        return (str_word_count($this->comment) < 5);
    }

    /**
     * @return int
     */
    protected function isReview()
    {
        return (strlen($this->comment) > 200);
    }
}