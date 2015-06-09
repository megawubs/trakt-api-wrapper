<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 02/04/15
 * Time: 19:02
 */

namespace Wubs\Trakt\Contracts;


use Wubs\Trakt\ClientId;

interface Executable
{
    public function setClientId(ClientId $clientId);

    public function setToken($token);

    public function getResponse();
}