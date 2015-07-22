<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 14:18
 */

namespace Wubs\Trakt\Response;


use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Exception\CheckInTypeNotSupportedException;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\Parameters\Type;

class CheckIn
{

    /**
     * @var Movie
     */
    public $media;

    private $sharing;
    private $id;
    /**
     * @var AccessToken
     */
    private $token;
    /**
     * @var ClientInterface
     */
    private $client;
    private $json;

    /**
     * @param $json
     * @param $id
     * @param AccessToken $token
     * @param ClientInterface $client
     */
    public function __construct($json, $id, AccessToken $token, ClientInterface $client)
    {
        $this->sharing = $json->sharing;
        $this->id = $id;
        $this->token = $token;
        $this->json = $json;
        $this->client = $client;
//        dump($this->client);

        $this->media = $this->makeMediaObject();
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function isSharedOnFacebook()
    {
        return $this->isSharedOn("facebook");
    }

    public function isSharedOnTwitter()
    {
        return $this->isSharedOn("twitter");
    }

    public function isSharedOnTumblr()
    {
        return $this->isSharedOn("tumblr");
    }

    private function isSharedOn($medium)
    {
        return $this->sharing->{$medium};
    }

    private function makeMediaObject()
    {
        if ($this->isMovie()) {
            return $this->json->movie;
        }
        if ($this->isEpisode()) {
            return $this->json->episode;
        }

        throw new CheckInTypeNotSupportedException(
            "The given object is of an unknown media type and can not be
        turned into an object"
        );
    }

    /**
     * @return bool
     */
    private function isMovie()
    {
        return property_exists($this->json, "movie");
    }

    /**
     * @return bool
     */
    private function isEpisode()
    {
        return property_exists($this->json, "episode");
    }
}