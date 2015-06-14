<?php


namespace Wubs\Trakt\Request\Users;


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
     * @param $section
     * @param $type
     */
    public function __construct($section, $type)
    {
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