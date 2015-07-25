<?php


namespace Wubs\Trakt\Api;


use GuzzleHttp\ClientInterface;
use Illuminate\Support\Collection;
use Wubs\Trakt\Request\AbstractRequest;

abstract class Endpoint
{

    /**
     * @var Collection
     */
    private $extended;

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
        $this->extended = new Collection(["min"]);

        $reflection = new \ReflectionClass($this);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $class = $this->parseDockBlock($property->getDocComment());
            $this->{$name} = $class->newInstanceArgs([$this->clientId, $this->client]);
        }

    }

    public function extendWithImages()
    {
        return $this->extend('images');
    }

    public function extendWithFull()
    {
        return $this->extend("full");
    }

    private function extend($level)
    {
        $this->extended->forget(0);
        $this->extended->push($level);
        return $this;
    }

    protected function request(AbstractRequest $request)
    {
        $request->setExtended($this->extended->implode(','));
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
        return new \ReflectionClass($match[0]);
    }
}