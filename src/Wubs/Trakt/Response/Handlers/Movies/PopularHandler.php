<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 14:31
 */

namespace Wubs\Trakt\Response\Handlers\Movies;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class PopularHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @return Movie[]
     */
    public function handle(ResponseInterface $response)
    {
        $json = $this->getJson($response);

        return $this->makeMovies($json);
    }

    /**
     * @param $json
     * @return array
     */
    private function makeMovies($json)
    {
        $movies = [];

        foreach ($json as $item) {
            $movies[] = new Movie($item, $this->getId(), $this->getToken());
        }

        return $movies;
    }
}