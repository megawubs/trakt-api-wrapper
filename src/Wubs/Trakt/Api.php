<?php


namespace Wubs\Trakt;

use Wubs\Trakt\Api\Calendars;
use Wubs\Trakt\Api\Movies;
use Wubs\Trakt\Api\Shows;

/**
 * Class Api
 * @package Wubs\Trakt
 */
class Api
{
    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var Movies
     */
    public $movies;

    /**
     * @var Calendars
     */
    public $calendars;

    /**
     * @var Shows
     */
    public $shows;

    /**
     * @param ClientId $id
     */
    public function __construct(ClientId $id)
    {
        $this->id = $id;
        $this->createWrappers($id);
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
            $this->{$name} = $reflection->newInstance($this->id);
        }
    }
}