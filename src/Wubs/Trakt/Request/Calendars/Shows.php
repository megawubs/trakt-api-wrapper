<?php namespace Wubs\Trakt\Request\Calendars;

use Carbon\Carbon;
use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;

/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 15:10
 */
class Shows extends AbstractRequest
{
    /**
     * @var int
     */
    private $days;
    /**
     * @var bool
     */
    private $startDate;

    /**
     * @param bool $startDate
     * @param int $days
     */
    public function __construct($days = 7, $startDate = false)
    {
        $this->days = $days;
        if (!$startDate) {
            $startDate = Carbon::today()->format("Y-m-d");
        }
        $this->startDate = $startDate;

        parent::__construct();
    }

//    protected function handleResponse(ResponseInterface $response)
//    {
//        return new \Wubs\Trakt\Response\Calendars\Shows($response);
//    }

    public function getMethod()
    {
        return RequestType::GET;
    }

    public function getUrl()
    {
        return "calendars/shows/" . $this->startDate . "/" . $this->days;
    }
}