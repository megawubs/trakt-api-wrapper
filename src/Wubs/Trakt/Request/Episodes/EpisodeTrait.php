<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 27/03/15
 * Time: 12:10
 */

namespace Wubs\Trakt\Request\Episodes;


trait EpisodeTrait
{

    /**
     * @var int
     */
    private $season;

    /**
     * @var int
     */
    private $episode;

    /**
     * @return int
     */
    public function getEpisode()
    {
        return $this->episode;
    }

    /**
     * @return int
     */
    public function getSeason()
    {
        return $this->season;
    }


}