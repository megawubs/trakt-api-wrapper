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
        $this->episode = $this->json->episode;
    }

    public function getTitle()
    {
        return $this->episode->title;
    }

    public function getIds()
    {
        return $this->episode->ids;
    }

    public function getShow()
    {
        return new Show($this->json->show, $this->id, $this->token);
    }

    public function getSeasonNumber()
    {
        return $this->episode->season;
    }

    public function getEpisodeNumber()
    {
        return $this->episode->number;
    }
}