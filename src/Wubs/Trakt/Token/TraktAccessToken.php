<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 14:49
 */

namespace Wubs\Trakt\Token;


use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Request\Parameters\AccessToken as TokenParameter;

class TraktAccessToken
{

    public static function create($token, $type, $expires, $refresh, $scope)
    {
        return new AccessToken(
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