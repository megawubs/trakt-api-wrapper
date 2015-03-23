<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 17:24
 */

namespace Wubs\Trakt\Response\Handlers\Calendars;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Media\Episode;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Response\Calendar\Day;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;

class Shows extends AbstractResponseHandler implements ResponseHandler
{
    /**
     * @param ResponseInterface $response
     * @return Day[]
     */
    public function handle(ResponseInterface $response)
    {
        $json = $this->getJson($response);

        return $this->toDays($json);
    }

    /**
     * @param $json
     * @return Day[]
     */
    private function toDays($json)
    {
        $days = [];

        foreach ($json as $date => $movies) {
            $days[] = new Day($date, $movies, $this->getId(), $this->getToken());
        }

        return $days;
    }
}