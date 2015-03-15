<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 16:41
 */

use Guzzle\Http\Client;
use Wubs\Trakt\ClientId;
use Wubs\Trakt\Media\Movie;
use Wubs\Trakt\Request\Parameters\Query;
use Wubs\Trakt\Request\Parameters\Year;
use Wubs\Trakt\Token\TraktAccessToken;

require __DIR__ . "/../vendor/autoload.php";

Dotenv::load(dirname(__DIR__));

function get_token()
{
    return TraktAccessToken::create(
        getenv("TRAKT_ACCESS_TOKEN"),
        getenv("TRAKT_TOKEN_TYPE"),
        getenv("TRAKT_EXPIRES_IN"),
        getenv("TRAKT_REFRESH_TOKEN"),
        getenv("TRAKT_SCOPE")
    );
}

function get_client_id()
{
    return ClientId::set(getenv("CLIENT_ID"));
}

/**
 * @param null $string
 * @return mixed
 */
function movie($string = null)
{
    $string = (is_null($string)) ? "guardians of the galaxy" : $string;

    $clientId = ClientId::set(getenv("CLIENT_ID"));

    $result = Movie::search($clientId, get_token(), Query::set($string), Year::set("2014"));

    return $result[0];
}