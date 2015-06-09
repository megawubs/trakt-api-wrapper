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
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->request = $request;

    }

    public function getResponse()
    {
        // TODO: Implement getResponse() method.
    }

    public function handleResponse(ResponseHandler $handler = null)
    {
        // TODO: Implement handleResponse() method.
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
