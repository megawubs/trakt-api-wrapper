<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 24/03/15
 * Time: 21:24
 */

namespace Wubs\Trakt\Request\Users;


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
     * @param string $username
     * @param string $type
     */
    public function __construct($username, $type)
    {
        parent::__construct();
        $this->username = $username;
        $this->type = $type;
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

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "users/:username/history/:type";
    }
}