<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:28
 */

namespace Wubs\Trakt\Response\Handlers\Search;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class TextSearchHandler extends AbstractResponseHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response)
    {
        $items = $response->json(["object" => true]);

        $result = [];

        foreach ($items as $item) {
            $result[] = new Movie($item->movie, $this->getId(), $this->getToken());
        }

        return $result;
    }
}