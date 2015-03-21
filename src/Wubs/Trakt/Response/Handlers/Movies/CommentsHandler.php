<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 11:54
 */

namespace Wubs\Trakt\Response\Handlers\Movies;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\Comment;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class CommentsHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @return Comment[]
     */
    public function handle(ResponseInterface $response)
    {
        $json = $this->getJson($response);

        return $this->makeComments($json);

    }

    /**
     * @param $json
     * @return array
     */
    private function makeComments($json)
    {
        $comments = [];

        foreach ($json as $item) {
            $comments[] = new Comment($item, $this->getId(), $this->getToken());
        }
        return $comments;
    }
}