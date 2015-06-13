#!/usr/bin/env php
<?php
use Symfony\Component\Console\Application;
use Wubs\Trakt\Console\TraktGenerateCommand;

require '../vendor/autoload.php';

$console = new Application("Trakt");

$console->add(new TraktGenerateCommand());

$console->run();
