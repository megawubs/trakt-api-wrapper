<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 17:24
 */

namespace Wubs\Trakt\Response\Calendars;


use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Response\AbstractResponse;

class Shows extends AbstractResponse
{
    public function handle()
    {
        $dates = $this->getResponse()->json(['object' => true]);

        return $this->makeEpisodes($dates);
    }

    /**
     * @param $dates
     * @return array
     */
    private function makeEpisodes($dates)
    {
        $episodeList = [];
        foreach ($dates as $episodes) {
            $this->makeEpisode($episodes);
        }

        return $episodeList;
    }

    /**
     * @param array $episodes
     * @param array $episodeList
     * @return Episode
     */
    private function makeEpisode(array $episodes = [], array $episodeList)
    {
        foreach ($episodes as $episode) {
            array_push($episodeList, new Episode($episode));
        }

        return $episodeList;
    }
}