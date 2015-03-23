<?php

use Wubs\Trakt\Trakt;

require '../vendor/autoload.php';

Dotenv::load(__DIR__ . "/../");
$trakt = new Trakt(
    getenv("CLIENT_ID"),
    getenv("CLIENT_SECRET"),
    getenv("TRAKT_REDIRECT_URI")
);

$token = $trakt->getAccessToken($_GET['code']);

var_dump($token);