<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 02/04/15
 * Time: 19:05
 */

namespace Wubs\Trakt\Contracts;


use Wubs\Trakt\ClientId;

class ExecutesRequest implements Executable
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var ResponseHandler
     */
    private $handler;

    /**
     * @param Request $request
     * @param ResponseHandler $handler
     */
    public function __construct(Request $request, ResponseHandler $handler)
    {

        $this->request = $request;

        $this->handler = $handler;
    }

    public function getResponse()
    {
        return $this->handleResponse($this->handler);
    }

    private function handleResponse(ResponseHandler $handler = null)
    {
        return "200";
    }

    public function setClientId(ClientId $clientId)
    {
        // TODO: Implement setClientId() method.
    }

    public function setToken($token)
    {
        // TODO: Implement setToken() method.
    }

}
