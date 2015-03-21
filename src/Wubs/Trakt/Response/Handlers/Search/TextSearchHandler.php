<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:28
 */

namespace Wubs\Trakt\Response\Handlers\Search;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Exception\MediaTypeNotSupportedException;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class TextSearchHandler extends AbstractResponseHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response)
    {
        $items = $this->getJson($response);

        $result = [];

        foreach ($items as $item) {
            $result[] = $this->toMedia($item);
        }

        return $result;
    }

    /**
     * @param $item
     * @return Movie|Show
     * @throws MediaTypeNotSupportedException
     */
    protected function toMedia($item)
    {
        $id = $this->getId();
        $token = $this->getToken();

        if ($this->isMovie($item)) {
            return new Movie($item, $id, $token);
        }

        if ($this->isShow($item)) {
            return new Show($item, $id, $token);
        }

        if ($this->isEpisode($item)) {
            return new Episode($item, $id, $token);
        }

        throw new MediaTypeNotSupportedException;
    }

    /**
     * @param $item
     * @return bool
     */
    protected function isMovie($item)
    {
        return $item->type == Type::movie();
    }

    /**
     * @param $item
     * @return bool
     */
    protected function isShow($item)
    {
        return $item->type == Type::show();
    }

    private function isEpisode($item)
    {
        return $item->type == Type::episode();
    }
}