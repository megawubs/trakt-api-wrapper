<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:05
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Country;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\RequestType;

class Releases extends AbstractRequest
{
    /**
     * @var Country
     */
    private $country;
    /**
     * @var MediaId
     */
    private $id;

    /**
     * @param MediaId $id
     * @param Country $country
     */
    public function __construct(MediaId $id, Country $country)
    {
        parent::__construct();
        $this->country = $country;
        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return MediaId
     */
    public function getId()
    {
        return $this->id;
    }


    public function getUri()
    {
        return "movies/:id/releases/:country";
    }
}