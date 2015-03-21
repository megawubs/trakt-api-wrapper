<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 18/03/15
 * Time: 15:12
 */

namespace Wubs\Trakt\Response;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\ClientId;

class People
{
    public $cast;

    public $crew;

    /**
     * @param $json
     * @param ClientId $id
     * @param AccessToken $token
     */
    public function __construct($json, ClientId $id, AccessToken $token)
    {
        $this->cast = $json->cast;

        $this->crew = $json->crew;
    }
}