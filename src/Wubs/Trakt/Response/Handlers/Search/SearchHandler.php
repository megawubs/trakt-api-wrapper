<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:28
 */

namespace Wubs\Trakt\Response\Handlers\Search;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Support\Collection;
use Wubs\Trakt\Exception\MediaTypeNotSupportedException;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class SearchHandler extends AbstractResponseHandler implements ResponseHandler
{

    public function handle(ResponseInterface $response, \GuzzleHttp\ClientInterface $client)
    {
        $items = $this->getJson($response);


        if ($this->getToken() !== null) {
            $result = new Collection();
            foreach ($items as $item) {
                $result->push($this->toMedia($item, $client));
            }
            return $result;
        }

        return collect($items);
    }

    /**
     * @param $item
     * @return Movie|Show
     * @throws MediaTypeNotSupportedException
     */
    protected function toMedia($item, ClientInterface $client)
    {
        $id = $this->getClientId();
        $token = $this->getToken();

        if ($this->isMovie($item)) {
            return new Movie($item, $id, $token, $client);
        }

        if ($this->isShow($item)) {
            return new Show($item, $id, $token, $client);
        }

        if ($this->isEpisode($item)) {
            return new Episode($item, $id, $token, $client);
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