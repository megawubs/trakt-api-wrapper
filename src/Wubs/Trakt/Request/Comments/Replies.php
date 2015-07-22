<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 13:00
 */

namespace Wubs\Trakt\Request\Comments;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Comments\CommentHandler;

class Replies extends AbstractRequest
{
    /**
     * @var
     */
    private $id;

    /**
     * @param $commentId
     */
    public function __construct($commentId)
    {
        parent::__construct();
        $this->id = $commentId;
        $this->setResponseHandler(new CommentHandler());
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUri()
    {
        return "comments/:id/replies";
    }
}