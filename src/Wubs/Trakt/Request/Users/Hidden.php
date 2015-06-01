<?php


namespace Wubs\Trakt\Request\Users;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\RequestType;

class Hidden extends AbstractRequest
{
    /**
     * @var Section
     */
    private $section;
    /**
     * @var Type
     */
    private $type;

    /**
     * @param Section $section
     * @param Type $type
     */
    public function __construct(Section $section, Type $type)
    {

        $this->section = $section;
        $this->type = $type;
    }

    /**
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
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
        return "users/hidden/:section?type=:type";
    }
}