<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 21:50
 */

namespace Wubs\Trakt\Contracts;


use Wubs\Trakt\TraktToken;

interface RequestInterface
{

    public function create($method, $path, TraktToken $token, $options = []);

    public function send();

    public function getRequest();

}