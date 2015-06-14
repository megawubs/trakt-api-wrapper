<?php
/*
|--------------------------------------------------------------------------
| Generated code
|--------------------------------------------------------------------------
| This class is auto generated. Please do not edit
|
|
*/
namespace Wubs\Trakt\Api;

use Wubs\Trakt\Request\Comments\DeleteComment as DeleteCommentRequest;
use Wubs\Trakt\Request\Comments\GetComment as GetCommentRequest;
use Wubs\Trakt\Request\Comments\Like as LikeRequest;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\Comments\PostComment as PostCommentRequest;
use Wubs\Trakt\Request\Comments\Replies as RepliesRequest;
use Wubs\Trakt\Request\Comments\UpdateComment as UpdateCommentRequest;

class Comments extends Endpoint {

    public function deleteComment($commentId)
    {
        return $this->request(new DeleteCommentRequest($commentId));
    }

	public function getComment($commentId)
    {
        return $this->request(new GetCommentRequest($commentId));
    }

	public function like($commentId)
    {
        return $this->request(new LikeRequest($commentId));
    }

	public function postComment(Media $media, $comment, $spoiler)
    {
        return $this->request(new PostCommentRequest($media, $comment, $spoiler));
    }

	public function replies($commentId)
    {
        return $this->request(new RepliesRequest($commentId));
    }

	public function updateComment($commentId, $comment, $spoiler)
    {
        return $this->request(new UpdateCommentRequest($commentId, $comment, $spoiler));
    }

}

