<?php


namespace Wubs\Trakt\Request\Users;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Hidden extends AbstractRequest
{
    /**
     * @var
     */
    private $section;
    /**
     * @var
     */
    private $type;

    /**
     * @param AccessToken $token
     * @param $section
     * @param $type
     */
    public function __construct(AccessToken $token, $section, $type)
    {
        parent::__construct();
        $this->setToken($token);
        $this->section = $section;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
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
        return "users/hidden/:section?type=:type";
    }
}