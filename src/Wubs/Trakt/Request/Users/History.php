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
    private $name;
    /**
     * @var Type
     */
    private $type;

    /**
     * @param UserName $name
     * @param Type $type
     */
    public function __construct(Username $name, Type $type)
    {
        parent::__construct();
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return Username
     */
    public function getName()
    {
        return $this->name;
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