<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 17:24
 */

namespace Wubs\Trakt\Response\Calendars;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Response\AbstractResponse;

class Shows extends AbstractResponse
{
    public function handle(ResponseInterface $response)
    {
        $dates = $response->json(['object' => true]);

        return $this->handleDates($dates);
    }

    /**
     * @param $dates
     * @return array
     */
    private function handleDates($dates)
    {
        $list = [];
        foreach ($dates as $episodes) {
            $list = array_merge($list, $this->handleEpisodes($episodes));
        }

        return $list;
    }

    /**
     * @param array $episodes
     * @return array
     */
    private function handleEpisodes(array $episodes = [])
    {
        $episodeList = [];
        foreach ($episodes as $episode) {
            $episodeList[] = $this->makeEpisode($episode);
        }
        return $episodeList;
    }

    /**
     * @param $episode
     * @return Episode
     */
    private function makeEpisode($episode)
    {
        return new Episode($episode);
    }
}