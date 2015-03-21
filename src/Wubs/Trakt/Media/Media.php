<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:30
 */

namespace Wubs\Trakt\Media;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\Calendars\Shows;
use Wubs\Trakt\Request\CheckIn\CheckIn;
use Wubs\Trakt\Request\CheckIn\CheckOut;
use Wubs\Trakt\Request\Comments\PostComment;
use Wubs\Trakt\Request\Movies\Comments;
use Wubs\Trakt\Request\Parameters\Comment;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\Parameters\Parameter;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\Search\Text;

abstract class Media
{
    protected $json;

    protected $standard = [];

    protected $id;
    /**
     * @var AccessToken
     */
    protected $token;

    /**
     * @param $json
     * @param $id
     * @param AccessToken $token
     */
    public function __construct($json, ClientId $id, AccessToken $token)
    {
        $this->json = $json;
        $this->id = $id;
        $this->token = $token;

        if ($this instanceof Movie) {
            $this->media = $json->movie;
        }
        if ($this instanceof Show) {
            $this->media = $json->show;
        }

        if ($this instanceof Person) {
            $this->media = $json->person;
        }
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

    public static function search($id, AccessToken $token, Parameter $query, Year $year = null)
    {
        if ($query instanceof Query) {
            return Text::request($id, $token, $query, Type::movie(), $year);
        }
    }

    public function checkIn()
    {
        return CheckIn::media($this->id, $this->token, $this);
    }

    public function checkOut()
    {
        return CheckOut::request($this->id, $this->token);
    }

    public function comment(Comment $comment)
    {
        return PostComment::request($this->id, $this->token, $this, $comment);
    }

    /**
     * @return \Wubs\Trakt\Response\Comment[]
     */
    public function comments()
    {
        $slug = $this->getSlug();
        return Comments::request($this->id, $this->token, MediaId::set($slug));
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
}