<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 24/03/15
 * Time: 21:24
 */

namespace Wubs\Trakt\Request\Users;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Username;
use Wubs\Trakt\Request\RequestType;

class History extends AbstractRequest
{
    /**
     * @var UserName
     */
    private $username;
    /**
     * @var Type
     */
    private $type;

    /**
     * @param Username $username
     * @param Type $type
     */
    public function __construct(Username $username, Type $type)
    {
        parent::__construct();
        $this->username = $username;
        $this->type = $type;
    }

    /**
     * @return Username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return Type
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