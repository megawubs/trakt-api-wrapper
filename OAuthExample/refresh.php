<?php
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

$token = $trakt->auth->refresh(getenv("TRAKT_REFRESH_TOKEN"));

dump($token);