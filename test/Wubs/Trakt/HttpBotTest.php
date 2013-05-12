<?php namespace Wubs\Trakt;

use Wubs\Settings\Settings;

class HttpBotTest extends \PHPUnit_Framework_TestCase{
	public function setUp(){
		$this->bot = new HttpBot();
		$this->s = new Settings();
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
		$uri = 'account/settings/'.$this->key;
		$this->bot->setUri($uri);
		$this->assertEquals('http://api.trakt.tv/account/settings/'.$this->key, $this->bot->url);
	}

	public function testGet(){
		$uri = 'activity/community.json/'.$this->key;
		$this->bot->setUri($uri);
		$this->assertTrue($this->bot->execute());
		$this->assertContainsOnly('array',$this->bot->response);
	}

	public function testPostWithJson(){
		$uri = 'account/test/'.$this->key;
		$this->bot->setUri($uri);
		$this->bot->setType('post');
		$username = $this->s->get('trakt.user');
		$pass = sha1($this->s->get('trakt.pass'));
		$params = '{"username":"'.$username.'","password":"'.$pass.'"}';
		$this->bot->setParams($params);
		$this->assertTrue($this->bot->execute(), 'Failed to execute Post to '.$this->bot->url.' With values: '. $params);
		$this->assertArrayHasKey('status', $this->bot->response);
		$this->assertEquals('success', $this->bot->response['status']);
	}
}