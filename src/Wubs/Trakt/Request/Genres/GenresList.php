<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 12/03/15
 * Time: 13:09
 */

namespace Wubs\Trakt\Request\Genres;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\RequestType;

class GenresList extends AbstractRequest
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "genres/list/" . $this->type;
    }
}