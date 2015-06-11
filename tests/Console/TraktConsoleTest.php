<?php


use Wubs\Trakt\Console\Trakt;

class TraktConsoleTest extends PHPUnit_Framework_TestCase
{

    public function testHowItShouldWork()
    {
        $traktConsole = new Trakt();

        $response = $traktConsole->generate();

        $this->assertEquals("Generated API classes", $response);
    }
}
