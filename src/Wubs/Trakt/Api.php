<?php


namespace Wubs\Trakt;

use GuzzleHttp\ClientInterface;
use Wubs\Trakt\Api\Calendars;
use Wubs\Trakt\Api\CheckIn;
use Wubs\Trakt\Api\Comments;
use Wubs\Trakt\Api\Episodes;
use Wubs\Trakt\Api\Genres;
use Wubs\Trakt\Api\Movies;
use Wubs\Trakt\Api\People;
use Wubs\Trakt\Api\Recommendations;
use Wubs\Trakt\Api\Scrobble;
use Wubs\Trakt\Api\Search;
use Wubs\Trakt\Api\Seasons;
use Wubs\Trakt\Api\Shows;
use Wubs\Trakt\Api\Users;

/**
 * Class Api
 * @package Wubs\Trakt
 */
class Api
{
    /**
     * @var
     */
    private $id;

    /**
     * @var Calendars
     */
    public $calendars;

    /**
     * @var CheckIn
     */
    public $checkIn;

    /**
     * @var Comments
     */
    public $comments;

    /**
     * @var Episodes
     */
    public $episodes;

    /**
     * @var Genres
     */
    public $genres;
    /**
     * @var Movies
     */
    public $movies;

    /**
     * @var People
     */
    public $people;

    /**
     * @var Recommendations
     */
    public $recommendations;

    /**
     * @var Scrobble
     */
    public $scrobble;

    /**
     * @var Search
     */
    public $search;

    /**
     * @var Seasons
     */
    public $seasons;
    /**
     * @var Shows
     */
    public $shows;

    /**
     * @var Users
     */
    public $users;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param int|ClientId $clientId
     * @param ClientInterface $client
     */
    public function __construct($clientId, ClientInterface $client)
    {
        $this->id = $clientId;
        $this->client = $client;

        $this->createWrappers();
    }

    /**
     * Creates the wrappers for all public properties and sets them.
     * When a public property is added, there should be a class representing
     * the property inside Wubs\Trakt\Api, otherwise it throws an ReflectionException
     */
    private function createWrappers()
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $this->createWrapperForPublicProperty($property);
        }
    }

    /**
     * @param \ReflectionProperty $property
     */
    private function createWrapperForPublicProperty($property)
    {
        if ($property->isPublic()) {
            $nameSpaceRoot = $property->class;
            $name = $property->getName();
            $className = "\\" . $nameSpaceRoot . "\\" . ucfirst($name);
            $reflection = new \ReflectionClass($className);
            $this->{$name} = $reflection->newInstance($this->id, $this->client);
        }
    }
}