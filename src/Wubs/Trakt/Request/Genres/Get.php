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

class Get extends AbstractRequest
{
    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        parent::__construct();
        $this->type = $type;
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getUri()
    {
        return "genres/list/:type";
    }
}