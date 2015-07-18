<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 14:22
 */

use Dotenv\Dotenv;
use Wubs\Trakt\Auth;
use Wubs\Trakt\Provider\TraktProvider;
use Wubs\Trakt\Trakt;
use Wubs\Trakt\TraktHttpClient;

require '../vendor/autoload.php';
session_start();
(new Dotenv(__DIR__ . "/../"))->load();

$provider = new TraktProvider(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));
$auth = new Auth($provider);

$trakt = new Trakt(getenv("CLIENT_ID"), TraktHttpClient::make(), $auth);

$trakt = $trakt->auth->authorize();