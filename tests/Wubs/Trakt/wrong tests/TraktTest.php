<?php

use Wubs\Trakt\Trakt;
use Wubs\Settings\Settings;

class TraktTest extends TraktTestCase{

	public function testCreateAccount(){
		$this->markTestSkipped('henk123 already created');
		$params = array('username'=>'henk123', 'password'=>sha1('secret'), 'email'=>'bram.wubs@gmail.com');
		$res = Trakt::post('account/create')->setParams($params)->run();
		$this->assertArrayHasKey('status', $res);
	}
	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testRequestNotExsistingApiRequest(){
		$res = Trakt::get('foo/bar')->run();
	}

	public function testPostAccount(){
		$this->assertArrayHasKey('status', Trakt::post('account/settings')->setParams($this->params)->run());
	}

	public function testPostSomething(){
		$this->assertInstanceOf('Wubs\\Trakt\\Base\\HttpBot', Trakt::post('account/test')->setParams($this->params));
	}
 
	public function testGetParams(){
		$this->assertInternalType('array', $this->params);
	}

	public function testPostTestRequest(){
		$res    = Trakt::post('account/test')->setParams($this->params)->run();
		$this->assertInternalType('array', $res);
		$this->assertArrayHasKey('status', $res);
		$this->assertEquals('success',$res['status']);
	}

	/**
	 * @expectedException Wubs\Trakt\Exceptions\TraktException
	 */
	public function testPostWithoudParameters(){
		Trakt::post('account/test')->run();
	}

	public function testMagicSetter(){
		$uri = Trakt::post('calendar/premieres')->setParams($this->params)
		->setDate('20110421')->uri->getUriArray();
		$this->assertArrayHasKey('date', $uri);
	}

	public function testUser(){
		$user = Trakt::user('megawubs');
		$this->assertInstanceOf('Wubs\\Trakt\\User', $user);
		$this->assertEquals('megawubs', $user->username);
	}


}