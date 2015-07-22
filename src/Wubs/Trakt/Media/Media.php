<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:30
 */

namespace Wubs\Trakt\Media;


use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\CheckIn\Create;
use Wubs\Trakt\Request\CheckIn\Delete;
use Wubs\Trakt\Request\Comments\Create as CreateCommend;
use Wubs\Trakt\Request\Movies\Comments;
use Wubs\Trakt\Request\Parameters\Type;

abstract class Media
{
    protected $json;

    protected $standard = [];

    protected $id;
    /**
     * @var AccessToken
     */
    protected $token;

    protected $type;
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param $json
     * @param $Id
     * @param AccessToken $token
     * @param ClientInterface $client
     */
    public function __construct($json, $Id, AccessToken $token, ClientInterface $client)
    {
        $this->json = $json;
        $this->id = $Id;
        $this->token = $token;
        $this->client = $client;

        $this->media = $this->getMedia($json);

        $this->setMediaFields();

    }

    public function json()
    {
        $json = $this->getStandardFields();

        return json_encode($json);
    }

    /**
     * @return array
     */
    public function getStandardFields()
    {
        $fields = [];
        foreach ($this->standard as $item) {
            $fields[$item] = $this->media->{$item};
        }
        return $fields;
    }

    /**
     * @param array $sharing
     * @param null $message
     * @param null $venueId
     * @param null $venueName
     * @param null $appVersion
     * @param null $appDate
     * @return \stdClass
     */
    public function checkIn(
        array $sharing = [],
        $message = null,
        $venueId = null,
        $venueName = null,
        $appVersion = null,
        $appDate = null
    ) {
        return (
        new Create(
            $this->token, $this, $message, $sharing, $venueId, $venueName, $appVersion, $appDate
        )
        )->make($this->id, $this->client);
    }

    public function checkOut()
    {
        return Delete::make($this->id, $this->token);
    }

    public function comment(Comment $comment)
    {
        return CreateCommend::make($this->id, $this->token, [$this, $comment]);
    }

    /**
     * @return \Wubs\Trakt\Response\Comment[]
     */
    public function comments()
    {
        $slug = $this->getSlug();
        return (new Comments($slug))->make($this->id, $this->client);
    }

    public function getTitle()
    {
        return $this->media->title;
    }

    public function getIds()
    {
        return $this->media->ids;
    }

    public function getSlug()
    {
        $ids = $this->getIds();
        return $ids->slug;
    }

    protected function setMediaFields()
    {
        foreach ($this->media as $key => $value) {
            $this->{$key} = $value;
        }
        foreach ($this->json as $key => $value) {
            if ($key != $this->type) {
                $this->{$key} = $value;
            }
        }

    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $json
     */
    private function getMedia($json)
    {
        if (property_exists($json, "type")) {
            if ($this instanceof Movie) {
                $this->type = Type::movie();
                return $json->movie;
            }
            if ($this instanceof Show) {
                $this->type = Type::show();
                return $json->show;
            }

            if ($this instanceof Person) {
                $this->type = Type::person();
                return $json->person;
            }
        }

        return $this->json;
    }
}