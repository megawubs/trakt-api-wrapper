<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 01/03/15
 * Time: 22:36
 */

namespace Wubs\Trakt\Media;


use League\OAuth2\Client\Token\AccessToken;

class Show extends Media
{

    protected $standard = ["title", "year", "ids"];
}