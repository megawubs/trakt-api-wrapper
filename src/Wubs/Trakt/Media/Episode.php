<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:52
 */

namespace Wubs\Trakt\Media;


use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Token\AccessToken;

class Episode extends Media
{

    protected $standard = ["season", "number", "title", "ids"];

    /**
     * @var Show
     */
    protected $show;

    public function __construct($json, $clientId, AccessToken $token, ClientInterface $client)
    {
        parent::__construct($json, $clientId, $token, $client);
        $this->media = $this->json->episode;
    }

    public function getTitle()
    {
        return $this->media->title;
    }

    public function getIds()
    {
        return $this->media->ids;
    }

    public function getShow()
    {
        return new Show($this->json->show, $this->id, $this->token, $this->client);
    }

    public function getSeasonNumber()
    {
        return $this->media->season;
    }

    public function getEpisodeNumber()
    {
        return $this->media->number;
    }
}