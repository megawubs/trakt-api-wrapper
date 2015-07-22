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

use Wubs\Trakt\Media\Media;
use Wubs\Trakt\Request\Comments\Create as CreateRequest;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Comments\Delete as DeleteRequest;
use Wubs\Trakt\Request\Comments\DeleteLike as DeleteLikeRequest;
use Wubs\Trakt\Request\Comments\Get as GetRequest;
use Wubs\Trakt\Request\Comments\Like as LikeRequest;
use Wubs\Trakt\Request\Comments\Replies as RepliesRequest;
use Wubs\Trakt\Request\Comments\Update as UpdateRequest;

class Comments extends Endpoint {

    public function create(Media $media, $comment, $spoiler = false)
    {
        return $this->request(new CreateRequest($media, $comment, $spoiler));
    }

	public function delete(AccessToken $token, $commentId)
    {
        return $this->request(new DeleteRequest($token, $commentId));
    }

	public function deleteLike(AccessToken $token, $commentId)
    {
        return $this->request(new DeleteLikeRequest($token, $commentId));
    }

	public function get($commentId)
    {
        return $this->request(new GetRequest($commentId));
    }

	public function like($commentId)
    {
        return $this->request(new LikeRequest($commentId));
    }

	public function replies($commentId)
    {
        return $this->request(new RepliesRequest($commentId));
    }

	public function update($commentId, $comment, $spoiler)
    {
        return $this->request(new UpdateRequest($commentId, $comment, $spoiler));
    }

}

