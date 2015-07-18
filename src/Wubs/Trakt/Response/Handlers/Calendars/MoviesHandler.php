<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 12:39
 */

namespace Wubs\Trakt\Response\Handlers\Calendars;


use GuzzleHttp\Message\ResponseInterface;
use Wubs\Trakt\Contracts\ResponseHandler;
use Wubs\Trakt\Request\Parameters\Days;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Response\Calendar\Calendar;
use Wubs\Trakt\Response\Calendar\Day;
use Wubs\Trakt\Response\Handlers\AbstractResponseHandler;
use Wubs\Trakt\Response\Handlers\DefaultResponseHandler;

class MoviesHandler extends AbstractResponseHandler implements ResponseHandler
{

    /**
     * @param ResponseInterface $response
     * @param \GuzzleHttp\ClientInterface|GuzzleHttp\ClientInterface $client
     * @return Calendar
     */
    public function handle(ResponseInterface $response, \GuzzleHttp\ClientInterface $client)
    {
        $json = $this->getJson($response);

        return new Calendar($json, Type::movie(), $this->getId(), $this->getToken(), $client);
    }
}