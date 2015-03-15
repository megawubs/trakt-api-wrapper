<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:49
 */

namespace Wubs\Trakt\Request\Comments;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\CommentId;
use Wubs\Trakt\Request\RequestType;

class GetComment extends AbstractRequest
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
        parent::__construct();
        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "comments/" . $this->id;
    }
}