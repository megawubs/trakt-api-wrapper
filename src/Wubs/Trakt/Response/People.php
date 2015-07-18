<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:12
 */

namespace Wubs\Trakt\Response;


use League\OAuth2\Client\Token\AccessToken;

class People
{
    public $cast;

    public $crew;

    /**
     * @param $json
     * @param $id
     * @param AccessToken $token
     */
    public function __construct($json, $id, AccessToken $token)
    {
        $this->cast = $json->cast;

        $this->crew = $json->crew;
    }
}