<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 24/03/15
 * Time: 21:24
 */

namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class History extends AbstractRequest
{
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $type;
    /**
     * @var null
     */
    private $id;

    /**
     * @param string $username
     * @param string $type
     * @param null $id
     * @param AccessToken $token
     */
    public function __construct($username, $type = null, $id = null, AccessToken $token = null)
    {
        parent::__construct();
        $this->setToken($token);
        $this->username = $username;
        $this->type = $type;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        if (is_string($this->type) && !is_null($this->id)) {
            return "users/:username/history/:type/:id";
        } elseif (is_null($this->id) && is_string($this->type)) {
            return "users/:username/history/:type";
        }

        return "users/:username/history";
    }
}