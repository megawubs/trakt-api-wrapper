<?php


namespace Wubs\Trakt;

use Wubs\Trakt\Api\Movies;

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
     * @var string
     *
     * The first part of the uri
     */
    private $collection;

    /**
     * @var Movies
     */
    public $movies;

    /**
     * @param ClientId $id
     */
    public function __construct(ClientId $id)
    {
        $this->id = $id;
        $this->movies = new Movies($id);
    }
}