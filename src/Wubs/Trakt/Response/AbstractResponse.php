<?php namespace Wubs\Trakt\Response;

use GuzzleHttp\Message\ResponseInterface;


/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 17:24
 */
abstract class AbstractResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    protected function getResponse()
    {
        return $this->response;
    }

    abstract public function handle();
}