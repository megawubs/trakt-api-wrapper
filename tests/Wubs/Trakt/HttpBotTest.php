<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;

class HttpBotTest extends \PHPUnit_Framework_TestCase{
	public function setUp(){
		$this->s   = new Settings();
		$this->key = $this->s->get('trakt.api');
	}

	public function tearDown(){
		unset($this->s);
	}

	public function testSetParamsAsArray(){
		$bot = new HttpBot('account/test');
		$params = array('username'=>'John');
		$this->assertInstanceOf('Wubs\\Trakt\\HttpBot', $bot->setParams($params));
	}

	public function testSetParamsAsString(){
		$bot = new HttpBot('account/test');
		$params = array('username'=>'John');
		$this->assertInstanceOf('Wubs\\Trakt\\HttpBot', $bot->setParams(json_encode($params)));
	}

	public function testSetUri(){
		$bot = new HttpBot('account/test');
		$uri = 'account/settings';
		$bot->setUri($uri);
		$api = $this->s->get('trakt.api');
		$this->assertEquals('account/settings/'.$api, $bot->getUri());
	}

	public function testGet(){
		$bot = new HttpBot('account/test');
		$uri = 'activity/community.json';
		$bot->setUri($uri);
		$this->assertTrue($bot->execute(), "Failed to execute Get to ".$bot->getUrl()."\n with result: ".json_encode($bot->getResponse()));
		$this->assertContainsOnly('array',$bot->getResponse());
	}

	public function testPostWithJson(){
		$bot = new HttpBot('account/test');
		$uri      = 'account/test';
		$bot->setUri($uri);
		$bot->setHTTPType('post');
		$username = $this->s->get('trakt.username');
		$pass     = $this->s->get('trakt.password');
		$params   = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$bot->setParams($params);
		$bot->addApiToUri();
		$this->assertTrue($bot->execute(), "\n Failed to execute Post to ".$bot->getUrl()."\nWith values: ". $params."\nGiven result was:".json_encode($bot->getResponse()));
		$this->assertArrayHasKey('status', $bot->getResponse());
		$this->assertEquals('success', $bot->getResponse()['status']);
	}

	/**
     * @expectedException Wubs\Trakt\Exceptions\TraktException
     */
	public function testAPIResponseWithFailure(){
		$bot = new HttpBot('account/test');
		$uri = 'activity/episodes.json';
		$bot->setUri($uri);
		$bot->execute();
		$res = $bot->getResponse();
	}
}