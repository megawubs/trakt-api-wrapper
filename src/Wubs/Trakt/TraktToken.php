<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 14:49
 */

namespace Wubs\Trakt;


use League\OAuth2\Client\Token\AccessToken;

class TraktToken extends AccessToken
{

    public function __construct($token, $type, $expires, $refresh, $scope)
    {
        parent::__construct(
            [
                "access_token" => $token,
                "token_type" => $type,
                "expires_in" => $expires,
                "refresh_token" => $refresh,
                "scope" => $scope
            ]
        );
    }
}