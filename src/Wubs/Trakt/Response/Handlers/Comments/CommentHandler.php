<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 15/03/15
 * Time: 17:08
 */

namespace Wubs\Trakt\Response\Handlers\Comments;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\Comment;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class CommentHandler extends AbstractResponseHandler implements ResponseHandler
{


    /**
     * @param ResponseInterface $response
     * @return Comment
     */
    public function handle(ResponseInterface $response)
    {
        $response = $this->getJson($response);

        return new Comment($response, $this->getId(), $this->getToken());
    }
}