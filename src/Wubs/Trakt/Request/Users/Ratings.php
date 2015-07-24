<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Ratings extends AbstractRequest
{
    /**
     * @var null
     */
    private $rating;
    /**
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $username;

    /**
     * @param $username
     * @param $type
     * @param null $rating
     * @param AccessToken|null $token
     */
    public function __construct($username, $type, $rating = null, AccessToken $token = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->rating = $rating;
        $this->type = $type;
        $this->username = $username;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    /**
     * @return null
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


    public function getUri()
    {
        if (!is_null($this->rating)) {
            return "users/:username/ratings/:type/:rating";
        }

        return "users/:username/ratings/:type";
    }
}