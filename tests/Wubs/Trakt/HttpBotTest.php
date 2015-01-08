<?php

use Wubs\Trakt\Base\HttpBot;
use Wubs\Settings\Settings;
use Wubs\Trakt\Base\Uri;

class HttpBotTest extends TraktTestCase{

	public function testSetParamsAsArray(){
		$uri = new Uri('account/test', $this->key);
		$bot = new HttpBot($uri);
		$params = array('username'=>'John');
		$this->assertInstanceOf('Wubs\\Trakt\\Base\\HttpBot', $bot->setParams($params));
	}

	public function testSetUri(){
		$uri = new Uri('account/test', $this->key);
		$bot = new HttpBot($uri);
		$uri = 'account/settings';
		$bot->setUri($uri);
		$uri = $bot->getUri();
		$this->assertInstanceOf("Wubs\\Trakt\\Base\\Uri", $uri);

	}

	public function testGet(){
		$uri = new Uri('activity/community', $this->key);
		$bot = new HttpBot($uri);
		$this->assertTrue($bot->execute(), "Failed to execute Get to ".$bot->getUrl()."\n with result: ".json_encode($bot->getResponse()));
		$this->assertContainsOnly('array',$bot->getResponse());
	}

	public function testPostWithJson(){
		$uri = new Uri('account/test', $this->key);
		$bot = new HttpBot($uri);
		$uri      = 'account/test';
		$bot->setUri($uri);
		$bot->setHTTPType('post');
		$username = $this->s->get('trakt.username');
		$pass     = $this->s->get('trakt.password');
		$params   = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$bot->setParams($params);
		$this->assertTrue($bot->execute(), "\n Failed to execute Post to ".$bot->getUrl()."\nWith values: ". $params."\nGiven result was:".json_encode($bot->getResponse()));
		$this->assertArrayHasKey('status', $bot->getResponse());
		$this->assertEquals('success', $bot->getResponse()['status']);
	}

	/**
     * @expectedException Wubs\Trakt\Exceptions\TraktException
     */
	public function testAPIResponseWithFailure(){
		$uri = new Uri('activity/episodes.json', $this->key);
		$bot = new HttpBot($uri);
		$bot->execute();
		$res = $bot->getResponse();
	}
}