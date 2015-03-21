<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:10
 */

namespace Wubs\Trakt\Request\Movies;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\MediaId;
use Wubs\Trakt\Request\RequestType;

class People extends AbstractRequest
{
    /**
     * @var MediaId
     */
    private $id;

    /**
     * @param MediaId $id
     */
    public function __construct(MediaId $id)
    {

        $this->id = $id;
    }

    public function getRequestType()
    {
        return RequestType::GET;
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
        return "movies/:id/people";
    }
}