<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:17
 */

namespace Wubs\Trakt\Response\Handlers\Scrobble;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Media\Show;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;
use Wubs\Trakt\TraktHttpClient;

class ScrobbleHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @param $client
     */
    public function handle(ResponseInterface $response, ClientInterface $client)
    {
        $json = $this->getJson($response);

        $response = new \stdClass();
        $response->action = $json->action;
        $response->progress = $json->progress;
        $response->sharing = $json->sharing;

        $medias = $this->makeMedias($json);

        foreach ($medias as $type => $media) {
            $response->$type = $media;
        }

        return $json;
    }

    private function makeMedias($json)
    {
        $medias = array();
        if (property_exists($json, 'show')) {
            $tmp = new \stdClass();
            $tmp->show = $json->show;
            $medias['show'] = new Show($tmp, $this->getClientId(), $this->getToken(), TraktHttpClient::make());
        }
        if (property_exists($json, 'episode')) {
            $tmp = new \stdClass();
            $tmp->episode = $json->episode;
            $medias['episode'] = new Episode($tmp, $this->getClientId(), $this->getToken(), TraktHttpClient::make());
        }
        if (property_exists($json, 'movie')) {
            $tmp = new \stdClass();
            $tmp->movie = $json->movie;
            $medias['movie'] = new Movie($tmp, $this->getClientId(), $this->getToken(), TraktHttpClient::make());
        }

        return $json;
    }
}