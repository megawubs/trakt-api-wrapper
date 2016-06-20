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
        if (!$this->extended->contains("images")) {
            return $this->extend('images');
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function withFull()
    {
        return $this->extend("full");
    }

    /**
     * @return $this
     */
    public function withoutSeasons()
    {
        return $this->extend('noseasons');
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
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * Requests the abstract request. But before it does so, it sets a few properties
     * on the request like the extended level, page and it's limit
     *
     * @param AbstractRequest $request
     * @return mixed
     * @throws \Wubs\Trakt\Request\Exception\HttpCodeException\RateLimitExceededException
     * @throws \Wubs\Trakt\Request\Exception\HttpCodeException\ServerErrorException
     * @throws \Wubs\Trakt\Request\Exception\HttpCodeException\ServerUnavailableException
     * @throws \Wubs\Trakt\Request\Exception\HttpCodeException\StatusCodeException
     */
    protected function request(AbstractRequest $request)
    {
        return $request
            ->setExtended($this->extended->implode(','))
            ->setPage($this->page)
            ->setLimit($this->limit)
            ->make($this->clientId, $this->client);
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