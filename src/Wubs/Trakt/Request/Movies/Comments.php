<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 11:31
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Movies\CommentsHandler;

class Comments extends AbstractRequest
{
    use MediaIdTrait;

    /**
     * @param MediaId $id
     */
    public function __construct(MediaId $id)
    {
        parent::__construct();
        $this->id = $id;
        $this->setResponseHandler(new CommentsHandler());
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "movies/:id/comments";
    }
}