<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 02/04/15
 * Time: 18:46
 */

namespace Wubs\Trakt\Contracts;


use Wubs\Trakt\ClientId;

interface Request
{
    public function getRequestType();

    public function getUri();

    public function setQueryParams(array $params);
}