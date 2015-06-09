<?php


namespace Wubs\Trakt;

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
     * @param ClientId $id
     */
    public function __construct(ClientId $id)
    {
        $this->id = $id;
        $this->movies = new Movies($id);
        $this->shows = new Shows($id);
    }
}