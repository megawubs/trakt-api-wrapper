<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 12:11
 */

namespace Wubs\Trakt\Request\Search;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Search\TextSearchHandler;

class Text extends AbstractRequest
{
    /**
     * @var
     */
    private $query;
    /**
     * @var
     */
    private $type;
    /**
     * @var
     */
    private $year;

    /**
     * @param string $query
     * @param string $type
     * @param int $year
     */
    public function __construct($query, $type = null, $year = null)
    {
        parent::__construct();

        $this->query = $query;
        $this->type = $type;
        $this->year = $year;

        $queryParams = $this->makeQueryParams();
        $this->setQueryParams($queryParams);
        $this->setResponseHandler(new TextSearchHandler());
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUri()
    {
        return "search";
    }

    private function makeQueryParams()
    {
        $params = [];

        $params['query'] = $this->query;

        if (!is_null($this->type)) {
            $params['type'] = $this->type;
        }

        if (!is_null($this->year)) {
            $params['year'] = $this->year;
        }

        return $params;
    }
}