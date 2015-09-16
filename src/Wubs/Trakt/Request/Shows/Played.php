<?php


namespace Wubs\Trakt\Request\Shows;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

class Played extends AbstractRequest
{
    /**
     * @var null
     */
    private $period;

    /**
     * @param null $period The period. Weekly, monthly or all. Defaults to weekly
     */
    public function __construct($period = null)
    {
        parent::__construct();
        $this->period = $period;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "shows/played/:period";
    }

    /**
     * @return null
     */
    public function getPeriod()
    {
        return $this->period;
    }
}