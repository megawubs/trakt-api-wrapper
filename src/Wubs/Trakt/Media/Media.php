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
use Wubs\Trakt\Request\CheckIn\CheckIn;
use Wubs\Trakt\Request\CheckIn\CheckOut;
use Wubs\Trakt\Request\Comments\PostComment;
use Wubs\Trakt\Request\Parameters\Comment;
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
            $fields[$item] = $this->json->{$item};
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

    public abstract function getTitle();

    public abstract function getIds();
}