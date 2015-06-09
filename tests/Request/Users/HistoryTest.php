<?php


use Wubs\Trakt\ClientId;
use Wubs\Trakt\Request\Parameters\Type;
use Wubs\Trakt\Request\Parameters\Username;
use Wubs\Trakt\Request\Users\History;

class HistoryTest extends PHPUnit_Framework_TestCase
{

    public function testThatItWorks()
    {
        $clientId = ClientId::set(getenv("CLIENT_ID"));

        $parameters = [Username::set('rolle'), Type::movies()];
        $response = History::request($clientId, $parameters);

        $this->assertInternalType("array", $response);
    }
}
