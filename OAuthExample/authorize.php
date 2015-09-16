<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 14:22
 */

use Dotenv\Dotenv;
use Wubs\Trakt\Auth\Auth;
use Wubs\Trakt\Auth\TraktProvider;
use Wubs\Trakt\Trakt;
use Wubs\Trakt\TraktHttpClient;

require '../vendor/autoload.php';
session_start();
(new Dotenv(__DIR__ . "/../"))->load();

$provider = new TraktProvider(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
$auth = new Auth($provider);

$trakt = new Trakt($auth, TraktHttpClient::make());

$trakt->auth->authorize();
//after authorization the user will be redirected to the page where you preform a token
// request. see token.php