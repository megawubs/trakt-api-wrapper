<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 19:01
 */

namespace Wubs\Trakt\Response;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\Comments\DeleteComment;
use Wubs\Trakt\Request\Parameters\CommentId;

class Comment
{
    /**
     * @var ClientId
     */
    private $clientId;
    private $json;
    /**
     * @var AccessToken
     */
    private $token;

    /**
     * @var CommentId
     */
    public $id;

    public $parentId;

    public $ceatedAt;

    public $comment;

    public $spoiler;

    public $review;

    public $replies;

    public $likes;

    public $user;

    /**
     * @param $json
     * @param ClientId $clientId
     * @param AccessToken $token
     */
    public function __construct($json, ClientId $clientId, AccessToken $token)
    {
        $this->clientId = $clientId;
        $this->json = $json;
        $this->token = $token;

        $this->setCeatedAt($json->created_at);
        $this->setId($json->id);
        $this->setParentId($json->parent_id);
        $this->setComment($json->comment);
        $this->setSpoiler($json->spoiler);
        $this->setReview($json->review);
        $this->setReplies($json->replies);
        $this->setLikes($json->likes);
        $this->setUser($json->user);
    }

    /**
     * @param mixed $ceatedAt
     */
    public function setCeatedAt($ceatedAt)
    {
        $this->ceatedAt = $ceatedAt;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = CommentId::set($id);
    }

    /**
     * @param mixed $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = CommentId::set($parentId);
    }

    /**
     * @param mixed $replies
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * @param mixed $spoiler
     */
    public function setSpoiler($spoiler)
    {
        $this->spoiler = $spoiler;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return CommentId
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return boolean
     */
    public function delete()
    {
        return DeleteComment::request($this->clientId, $this->token, $this->getId());
    }


}