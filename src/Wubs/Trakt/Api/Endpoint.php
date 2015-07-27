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

    private $page = 1;

    private $limit = 10;

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

    /**
     * @return $this
     */
    public function withImages()
    {
        return $this->extend('images');
    }

    /**
     * @return $this
     */
    public function withFull()
    {
        return $this->extend("full");
    }

    /**
     * @param $level
     * @return $this
     */
    private function extend($level)
    {
        $this->extended->forget(0);
        $this->extended->push($level);
        return $this;
    }

    /**
     * @param mixed $page
     * @return $this
     */
    public function page($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param int $limit
     * @return Endpoint
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    protected function request(AbstractRequest $request)
    {
        $request->setExtended($this->extended->implode(','));
        $request->setPage($this->page);
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