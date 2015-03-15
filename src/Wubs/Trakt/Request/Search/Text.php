<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 14/03/15
 * Time: 12:11
 */

namespace Wubs\Trakt\Request\Search;


use Wubs\Trakt\Request\AbstractRequest;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Request\RequestType;
use Wubs\Trakt\Response\Handlers\Search\TextSearchHandler;

class Text extends AbstractRequest
{
    /**
     * @var Query
     */
    private $query;
    /**
     * @var Type
     */
    private $type;
    /**
     * @var Year
     */
    private $year;

    /**
     * @param Query $query
     * @param Type $type
     * @param Year $year
     */
    public function __construct(Query $query, Type $type = null, Year $year = null)
    {
        parent::__construct();

        $this->query = $query;
        $this->type = $type;
        $this->year = $year;

        $queryParams = $this->makeQueryParams();
        $this->setQueryParams($queryParams);
    }

    public function getRequestType()
    {
        return RequestType::GET;
    }

    public function getUrl()
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

    protected function getResponseHandler()
    {
        return TextSearchHandler::class;
    }


}