<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;

class HttpBotTest extends \PHPUnit_Framework_TestCase{
	public function setUp(){
		$this->bot = new HttpBot();
		$this->s   = new Settings();
		$this->key = $this->s->get('trakt.api');
	}

	public function tearDown(){
		unset($this->bot);
	}

	public function testSetParamsAsArray(){
		$params = array('username'=>'John');
		$this->assertInstanceOf('Wubs\\Trakt\\HttpBot', $this->bot->setParams($params));
	}

	public function testSetParamsAsString(){
		$params = array('username'=>'John');
		$this->assertInstanceOf('Wubs\\Trakt\\HttpBot', $this->bot->setParams(json_encode($params)));
	}

	public function testSetUri(){
		$uri = 'account/settings';
		$this->bot->setUri($uri);
		$api = $this->s->get('trakt.api');
		$this->assertEquals('account/settings/'.$api, $this->bot->getUri());
	}

	public function testGet(){
		$uri = 'activity/community.json';
		$this->bot->setUri($uri);
		$this->assertTrue($this->bot->execute(), "Failed to execute Get to ".$this->bot->getUrl()."\n with result: ".json_encode($this->bot->getResponse()));
		$this->assertContainsOnly('array',$this->bot->getResponse());
	}

	public function testPostWithJson(){
		$uri      = 'account/test';
		$this->bot->setUri($uri);
		$this->bot->setHTTPType('post');
		$username = $this->s->get('trakt.username');
		$pass     = $this->s->get('trakt.password');
		$params   = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$this->bot->setParams($params);
		$this->bot->addApiToUri();
		$this->assertTrue($this->bot->execute(), "\n Failed to execute Post to ".$this->bot->getUrl()."\nWith values: ". $params."\nGiven result was:".json_encode($this->bot->getResponse()));
		$this->assertArrayHasKey('status', $this->bot->getResponse());
		$this->assertEquals('success', $this->bot->getResponse()['status']);
	}

	/**
     * @expectedException Wubs\Trakt\Exceptions\TraktException
     */
	public function testAPIResponseWithFailure(){
		$uri = 'activity/episodes.json';
		$this->bot->setUri($uri);
		$this->bot->execute();
		$res = $this->bot->getResponse();
	}
}