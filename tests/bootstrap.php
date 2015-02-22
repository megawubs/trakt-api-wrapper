<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 22/02/15
 * Time: 16:41
 */

use Wubs\Trakt\TraktToken;

require __DIR__ . "/../vendor/autoload.php";

Dotenv::load(dirname(__DIR__));

function get_token()
{
    return new TraktToken(
        getenv("TRAKT_ACCESS_TOKEN"),
        getenv("TRAKT_TOKEN_TYPE"),
        getenv("TRAKT_EXPIRES_IN"),
        getenv("TRAKT_REFRESH_TOKEN"),
        getenv("TRAKT_SCOPE")
    );
}