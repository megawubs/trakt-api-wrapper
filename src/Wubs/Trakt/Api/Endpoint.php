<?php


namespace Wubs\Trakt\Api;


use GuzzleHttp\ClientInterface;
use Wubs\Trakt\Request\AbstractRequest;

abstract class Endpoint
{

    private $clientId;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param string $clientId
     * @param ClientInterface $client
     */
    public function __construct($clientId, ClientInterface $client)
    {
        $this->clientId = $clientId;
        $this->client = $client;

        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $class = $this->parseDockBlock($property->getDocComment());
            $this->{$name} = $class->newInstanceArgs([$this->clientId, $this->client]);
        }

    }

    protected function request(AbstractRequest $request)
    {
        return $request->make($this->clientId, $this->client);
    }

    /**
     * @param $dockBlock
     * @return \ReflectionClass
     */
    private function parseDockBlock($dockBlock)
    {
        $match = [];
        preg_match('/(?<=@var\s).+/', $dockBlock, $match);
        dump($match);
        return new \ReflectionClass($match[0]);
    }
}