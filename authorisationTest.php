<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 25/02/15
 * Time: 14:22
 */

use Wubs\Trakt\Trakt;

require 'vendor/autoload.php';
Dotenv::load(__DIR__);
$trakt = new Trakt(getenv("CLIENT_ID"), getenv("CLIENT_SECRET"), getenv("TRAKT_REDIRECT_URI"));

$trakt->authorize();