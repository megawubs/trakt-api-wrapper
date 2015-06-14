<?php


namespace Wubs\Trakt\Api;


use Wubs\Trakt\Request\AbstractRequest;

abstract class Endpoint
{

    private $clientId;

    /**
     * @param string $clientId
     */
    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    protected function request(AbstractRequest $request)
    {
        return $request->make($this->clientId);
    }
}