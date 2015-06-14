<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:05
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaIdTrait;
use Wubs\Trakt\Request\RequestType;

class Releases extends AbstractRequest
{
    use MediaIdTrait;
    /**
     * @var string
     */
    private $country;


    /**
     * @param int $mediaId
     * @param string $country
     */
    public function __construct($mediaId, $country)
    {
        parent::__construct();
        $this->country = $country;
        $this->id = $mediaId;
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

    public function getUri()
    {
        return "movies/:id/releases/:country";
    }
}