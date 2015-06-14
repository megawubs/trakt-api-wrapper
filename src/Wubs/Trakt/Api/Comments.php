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

use Wubs\Trakt\Request\Comments\DeleteComment as RequestDeleteComment;
use Wubs\Trakt\Request\Comments\GetComment as RequestGetComment;
use Wubs\Trakt\Request\Comments\Like as RequestLike;
use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\Comments\PostComment as RequestPostComment;
use Wubs\Trakt\Request\Comments\Replies as RequestReplies;
use Wubs\Trakt\Request\Comments\UpdateComment as RequestUpdateComment;

class Comments extends Endpoint {

    public function deleteComment( $commentId)
    {
        return $this->request(new RequestDeleteComment($commentId));
    }

	public function getComment( $commentId)
    {
        return $this->request(new RequestGetComment($commentId));
    }

	public function like( $commentId)
    {
        return $this->request(new RequestLike($commentId));
    }

	public function postComment(Media $media,  $comment,  $spoiler)
    {
        return $this->request(new RequestPostComment($media, $comment, $spoiler));
    }

	public function replies( $commentId)
    {
        return $this->request(new RequestReplies($commentId));
    }

	public function updateComment( $commentId,  $comment,  $spoiler)
    {
        return $this->request(new RequestUpdateComment($commentId, $comment, $spoiler));
    }

}

